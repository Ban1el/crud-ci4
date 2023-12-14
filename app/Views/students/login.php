<?= $this->extend('layouts/frontend'); ?>
<?= $this->section('content'); ?>

<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Login</h5>
                    </div>

                    <div class="card-body">
                        <form action="<?= base_url('login_user'); ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="form-group mb-3">
                                <label for="username-field">Username</label>
                                <input type="text" class="form-control" id="username-field" name="username" value=<?= old('username') ?>>

                                <strong class="text-danger">
                                    <?php
                                    if (!empty(session()->getFlashdata('validationErrors')['username'])) {
                                        echo session()->getFlashdata('validationErrors')['username'];
                                    }
                                    ?>
                                </strong>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password-field">Password</label>
                                <input type="password" class="form-control" id="password-field" name="password">
                                <strong class="text-danger">
                                    <?php
                                    if (!empty(session()->getFlashdata('validationErrors')['password'])) {
                                        echo session()->getFlashdata('validationErrors')['password'];
                                    }
                                    ?>
                                </strong>
                            </div>

                            <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-sm btn-primary px-5" value="login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<?= $this->endSection(); ?>