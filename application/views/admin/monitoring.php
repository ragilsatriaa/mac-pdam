<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/kategori'); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-sm-4 col-xl-4">
                    <div class="form-group">
                        <label for="by_tahun">Tahun</label>
                        <select class="js-select2 form-control" name="by_tahun" id="by_tahun">
                            <option value="">-- Pilih Tahun --</option>
                            <?php foreach ($tahun as $th) : ?>
                                <option value="<?= $th->tahun; ?>" <?= ($th->tahun == $th_ini) ? 'selected' : ''; ?>>
                                    <?= $th->tahun; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4 col-xl-4">
                    <div class="form-group">
                        <label for="by_tahun">Bulan</label>
                        <select class="js-select2 form-control" name="by_bulan" id="by_bulan">
                            <option value="">-- Pilih Bulan --</option>
                            <?php foreach (range(1, 12) as $bulan) : ?>
                                <option value="<?= $bulan; ?>" <?= ($bulan == $bln_ini) ? 'selected' : ''; ?>>
                                    <?= bulan($bulan); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="example">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>ID Pelanggan</th>
                                            <th>Nama</th>
                                            <th>Total Liter</th>
                                            <th>Total Kubik</th>
                                            <th>Total Biaya</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($data as $dt) : ?>
                                            <tr>
                                                <td class="text-center"><?= $i++; ?></td>
                                                <td><?= $dt->pelanggan_id; ?></td>
                                                <td><?= $dt->nama; ?></td>
                                                <td><?= $dt->totalLitres; ?></td>
                                                <td><?= $dt->kubik; ?></td>
                                                <td>Rp. <?= number_format($dt->totalBiaya); ?></td>
                                                <td>
                                                    <a href="<?= base_url('monitoring/cetak/' . $dt->id); ?>" class="btn btn-primary" target="_blank">Cetak</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- modal add -->
<div class="modal fade" id="addKategori" tabindex="-1" role="dialog" aria-labelledby="addKategori" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/menu/add'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Menu</label>
                                <input type="text" class="form-control" name="nama_menu">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" class="form-control" name="harga">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputState">Kategori</label>
                            <select id="inputState" class="form-control" name="kategori_id">
                                <option selected>Choose...</option>
                                <?php foreach ($kategori as $kat) : ?>
                                    <option value="<?= $kat->id; ?>"><?= $kat->kategori; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editMenu" tabindex="-1" role="dialog" aria-labelledby="editMenu" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/menu/edit'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label>Nama Menu</label>
                                <input type="text" class="form-control" name="nama_menu" id="nama_menu">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" class="form-control" name="harga" id="harga">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Kategori</label>
                            <select name="kategori_id" class="form-control" id="kategori_id">
                                <?php foreach ($kategori as $kat) : ?>
                                    <option value="<?= $kat->id; ?>"><?= $kat->kategori; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#by_tahun').change(function() {
        let tahun = $(this).find(':selected').val();

        if (tahun === '') {
            return 0;
        }

        document.location.href = `<?php echo base_url('monitoring/') ?>${tahun}`;
    });

    $('#by_bulan').change(function() {
        let tahun = $('#by_tahun').find(':selected').val();
        let bulan = $(this).find(':selected').val();

        if (bulan === '') {
            return 0;
        }

        document.location.href = `<?php echo base_url('monitoring/') ?>${tahun}/${bulan}`;
    });
</script>