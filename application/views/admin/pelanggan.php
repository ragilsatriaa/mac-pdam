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
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addKategori">Tambah Pelanggan</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="example">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>ID Pelanggan</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Kran</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($pelanggan as $data) : ?>
                                            <tr>
                                                <td class="text-center"><?= $i++; ?></td>
                                                <td><?= $data->pelanggan_id; ?></td>
                                                <td><?= $data->nama; ?></td>
                                                <td><?= $data->alamat; ?></td>
                                                <?php if ($data->selenoid == 0) : ?>
                                                    <td>
                                                        <div class="badge badge-danger">
                                                            <span>OFF</span>
                                                        </div>
                                                    </td>
                                                <?php else : ?>
                                                    <td>
                                                        <div class="badge badge-success">
                                                            <span>ON</span>
                                                        </div>
                                                    </td>

                                                <?php endif; ?>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item edit_btn" href="#" data-toggle="modal" data-target="#editPelanggan" data-id="<?= $data->id; ?>" data-pelanggan_id="<?= $data->pelanggan_id; ?>" data-nama="<?= $data->nama; ?>" data-alamat="<?= $data->alamat; ?>">edit</a>

                                                            <a class="dropdown-item" href="<?= base_url('pelanggan/delete/' . $data->id); ?>" onclick="return confirm('Apakah yakin data pelanggan akan dihapus?')">delete</a>

                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleSelenoid<?= $data->id; ?>">kran</a>
                                                        </div>
                                                    </div>
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
            <form action="<?= base_url('pelanggan/add'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ID Pelanggan</label>
                                <input type="text" class="form-control" name="pelanggan_id">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Pelanggan</label>
                                <input type="text" class="form-control" name="nama">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" type="text"></textarea>
                            </div>
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
<div class="modal fade" id="editPelanggan" tabindex="-1" role="dialog" aria-labelledby="editPelanggan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pelanggan/edit'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label>ID Pelanggan</label>
                                <input type="text" class="form-control" name="pelanggan_id" id="pelanggan_id">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Pelanggan</label>
                                <input type="text" class="form-control" name="nama" id="nama">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" type="text" id="alamat"></textarea>
                            </div>
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

<!-- Modal -->
<?php foreach ($pelanggan as $data) : ?>
    <div class="modal fade" id="exampleSelenoid<?= $data->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('pelanggan/editSelenoid'); ?>" method="post">
                        <input type="hidden" value="<?= $data->id; ?>" name="id">
                        <div class="form-group">
                            <input class="form-control" type="text" name="pelanggan_id" value="<?= $data->pelanggan_id; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih status</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="selenoid">
                                <option value="0" <?= ($data->selenoid == 0) ? 'selected' : '' ?>>OFF</option>
                                <option value="1" <?= ($data->selenoid == 1) ? 'selected' : '' ?>>ON</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    let edit_btn = $('.edit_btn');

    $(edit_btn).each(function(i) {
        $(edit_btn[i]).click(function() {
            let id = $(this).data('id');
            let pelanggan_id = $(this).data('pelanggan_id');
            let nama = $(this).data('nama');
            let alamat = $(this).data('alamat');

            $('#id').val(id);
            $('#pelanggan_id').val(pelanggan_id);
            $('#nama').val(nama);
            $('#alamat').val(alamat);
        });
    });
</script>