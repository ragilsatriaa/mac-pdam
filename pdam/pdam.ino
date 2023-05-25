// Wifi
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>

ESP8266WiFiMulti WiFiMulti;

HTTPClient http;
#define USE_SERIAL Serial

String simpan = "http://mac.phbcomputerc.my.id/data/save?pelanggan_id=52124&totalLitres=";
String lastData = "http://mac.phbcomputerc.my.id/data/getLastData?pelanggan_id=52124";
String urlGetSelenoid = "http://mac.phbcomputerc.my.id/data/settingSelenoid?pelanggan_id=52124";

String respon = "", responLastData = "";
String  statusSelenoid, responSelenoid;
bool checkLastData = false;

#define LED_BUILTIN 16
#define SENSOR D4
#define pinSelenoid D5

long currentMillis = 0;
long previousMillis = 0;
int interval = 1000;
boolean ledState = LOW;
float calibrationFactor = 4.5;
volatile byte pulseCount;
byte pulse1Sec = 0;
float flowRate;
unsigned long flowMilliLitres;
unsigned int totalMilliLitres;
float flowLitres;
float totalLitres;
float kubik;

// biaya meter perkubik
int biayaLiter = 10000;

// total biaya
int totalBiaya = 0;

#define relay_on LOW
#define relay_off HIGH

void IRAM_ATTR pulseCounter()
{
  pulseCount++;
}

void setup()
{
  Serial.begin(115200);

  pinMode(pinSelenoid, OUTPUT);
  digitalWrite(pinSelenoid, relay_on);
  
  USE_SERIAL.begin(115200);
  USE_SERIAL.setDebugOutput(false);

  for (uint8_t t = 4; t > 0; t--)
  {
    USE_SERIAL.printf("[SETUP] Tunggu %d...\n", t);
    USE_SERIAL.flush();
    delay(1000);
  }

  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP("mac", "12345678"); // Sesuaikan SSID dan password ini

  for (int u = 1; u <= 5; u++)
  {
    if ((WiFiMulti.run() == WL_CONNECTED))
    {
      USE_SERIAL.println("Wifi Connected");
      USE_SERIAL.flush();
      delay(1000);
    }
    else
    {
      Serial.println("Wifi not Connected");
      delay(1000);
    }
  }

  pinMode(LED_BUILTIN, OUTPUT);
  pinMode(SENSOR, INPUT_PULLUP);

  pulseCount = 0;
  flowRate = 0.0;
  flowMilliLitres = 0;
  totalMilliLitres = 0;
  previousMillis = 0;

  attachInterrupt(digitalPinToInterrupt(SENSOR), pulseCounter, FALLING);

  Serial.println("MONITORING PDAM");

  while (checkLastData == false)
  {
    getLastData();
    delay(1000);
  }

  delay(1000);
}

void loop()
{
  statusSelenoid = "0";
  readWaterFlow();
  getSelenoid();
}

void readWaterFlow()
{
  currentMillis = millis();
  if (currentMillis - previousMillis > interval)
  {

    pulse1Sec = pulseCount;
    pulseCount = 0;

    flowRate = ((1000.0 / (millis() - previousMillis)) * pulse1Sec) / calibrationFactor;
    previousMillis = millis();

    flowMilliLitres = (flowRate / 60) * 1000;
    flowLitres = (flowRate / 60);

    // Add the millilitres passed in this second to the cumulative total
    totalMilliLitres += flowMilliLitres;
    totalLitres += flowLitres;

    kubik = totalLitres / 1000;

    totalBiaya = biayaLiter * (kubik);

    // Print the flow rate for this second in litres / minute
    Serial.print("Flow rate: ");
    Serial.print(float(flowRate)); // Print the integer part of the variable
    Serial.print("L/min");
    Serial.print("\t"); // Print tab space

    // Print the cumulative total of litres flowed since starting
    Serial.print("Output Liquid Quantity: ");
    Serial.print(totalMilliLitres);
    Serial.print("mL / ");
    Serial.print(totalLitres);
    Serial.print("L");
    Serial.print("\t");

    Serial.print("Volume : ");
    Serial.print(kubik);
    Serial.println("m3");

    Serial.println();

    send_database();
  }
}

void send_database()
{
  if ((WiFiMulti.run() == WL_CONNECTED))
  {
    http.begin(simpan + (String)totalLitres + "&kubik=" + (String)kubik + "&totalBiaya=" + (String)totalBiaya);

    USE_SERIAL.print("[HTTP] Kirim data ke database ...\n");
    int httpCode = http.GET();

    if (httpCode > 0)
    {
      USE_SERIAL.printf("[HTTP] kode response GET : %d\n", httpCode);

      if (httpCode == HTTP_CODE_OK) // code 200
      {
        respon = http.getString();
        USE_SERIAL.println("Respon : " + respon);
      }
    }
    else
    {
      USE_SERIAL.printf("[HTTP] GET data gagal, error: %s\n", http.errorToString(httpCode).c_str());
    }
    http.end();
  }

  Serial.println();
}

void getLastData()
{
  if ((WiFiMulti.run() == WL_CONNECTED))
  {
    http.begin(lastData);

    USE_SERIAL.print("[HTTP] Get last data di database ...\n");
    int httpCode = http.GET();

    if (httpCode > 0)
    {
      USE_SERIAL.printf("[HTTP] kode response GET : %d\n", httpCode);

      if (httpCode == HTTP_CODE_OK) // code 200
      {
        responLastData = http.getString();
        USE_SERIAL.println("Respon : " + responLastData);

        checkLastData = true;

        totalLitres = getValue(responLastData, '#', 0).toFloat();
        totalMilliLitres = totalLitres * 1000;

        kubik = getValue(responLastData, '#', 1).toFloat();
        totalBiaya = getValue(responLastData, '#', 0).toInt();
      }
    }
    else
    {
      USE_SERIAL.printf("[HTTP] GET data gagal, error: %s\n", http.errorToString(httpCode).c_str());
    }
    http.end();
  }

  Serial.println();
}

void getSelenoid()
{
  if ((WiFiMulti.run() == WL_CONNECTED))
  {
    USE_SERIAL.print("[HTTP] Memulai...\n");

    http.begin(urlGetSelenoid);

    USE_SERIAL.print("[HTTP] Ambil data selenoid di database ...\n");
    int httpCode = http.GET();

    if (httpCode > 0)
    {
      USE_SERIAL.printf("[HTTP] kode response GET : %d\n", httpCode);

      if (httpCode == HTTP_CODE_OK)
      {
        Serial.println();

        responSelenoid = http.getString();

        statusSelenoid = getValue(responSelenoid, '#', 0);

        USE_SERIAL.println("statusSelenoid : " + statusSelenoid);
        delay(200);
      }
    }
    else
    {
      USE_SERIAL.printf("[HTTP] GET data gagal, error: %s\n", http.errorToString(httpCode).c_str());
    }
    http.end();
  }

  Serial.println();

  if (statusSelenoid == "1")
  {
    Serial.println("Selenoid aktif");
    digitalWrite(pinSelenoid, relay_on);
  }
  else
  {
    Serial.println("Selenoid non aktif");
    digitalWrite(pinSelenoid, relay_off);
  }

  delay(2000);
}

String getValue(String data, char separator, int index)
{
  int found = 0;
  int strIndex[] = {0, -1};
  int maxIndex = data.length() - 1;

  for (int i = 0; i <= maxIndex && found <= index; i++)
  {
    if (data.charAt(i) == separator || i == maxIndex)
    {
      found++;
      strIndex[0] = strIndex[1] + 1;
      strIndex[1] = (i == maxIndex) ? i + 1 : i;
    }
  }

  return found > index ? data.substring(strIndex[0], strIndex[1]) : "";
}
