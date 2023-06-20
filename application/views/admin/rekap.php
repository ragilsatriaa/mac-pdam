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
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hover" id="examples">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Bulan</th>
											<th>ID Pelanggan</th>
											<th>Nama</th>
											<th>Total Penggunaan</th>
											<th>Total Biaya</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($data as $dt) : ?>
											<tr>
												<td class="text-center"><?= $i++; ?></td>
												<td><?= date('M Y', strtotime($dt->tanggal)); ?></td>
												<td><?= $dt->pelanggan_id; ?></td>
												<td><?= $dt->nama; ?></td>
												<td><?= $dt->kubik; ?> m<sup>3</sup></td>
												<td>Rp. <?= number_format($dt->totalBiaya, 0, ',', '.'); ?></td>
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