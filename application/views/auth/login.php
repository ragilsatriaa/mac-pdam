<div class="login-box">
    <!-- /.login-logo -->
    <div class="register-logo">
        <a href="../../index2.html"><b>Meteran Air Cerdas</a>
    </div>
    <?php if ($this->session->flashdata('msg-error')) : ?>
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Username atau password salah
        </div>
    <?php endif; ?>
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h4>Login Admin</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('auth/proses'); ?>" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="username..." name="username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <hr>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>