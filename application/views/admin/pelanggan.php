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
                                            <th>Selenoid</th>
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
                                                        </div>
                                                    </div>
                                                <td>
                                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                        <label class="btn btn-primary">
                                                            <input type="radio" name="selenoid" value="1" id="on" data-id="<?= $data->id; ?>"> ON
                                                        </label>
                                                        <label class="btn btn-danger">
                                                            <input type="radio" name="selenoid" value="0" id="off" data-id="<?= $data->id; ?>"> OFF
                                                        </label>
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

    $('#on').click(function() {
        const id = $(this).data('id');
        const selenoid = $(this).val();

        handleSelenoid(id, selenoid);
    });

    $('#off').click(function() {
        const id = $(this).data('id');
        const selenoid = $(this).val();

        handleSelenoid(id, selenoid);
    });

    function handleSelenoid(id, selenoid) {
        document.location.href = `<?php echo base_url('pelanggan/editSelenoid/') ?>${id}/${selenoid}`;
    }
</script>