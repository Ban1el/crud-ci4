<?= $this->extend('layouts/frontend'); ?>
<?= $this->section('content'); ?>

<?= $this->include('inc/navbar'); ?>

<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5>Register Account</h5>
                </div>

                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group mb-3">
                            <label for="username-field" class="form-label fw-bold">Username</label>
                            <input type="text" class="form-control" id="username-field">
                        </div>

                        <div class="form-group mb-3">
                            <label for="name-field" class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control" id="name-field">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email-field" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="email-field">
                        </div>

                        <div class="form-group mb-3">
                            <label for="mobile-field" class="form-label fw-bold">Mobile No.</label>
                            <input type="text" class="form-control" id="mobile-field">
                        </div>

                        <div class="form-group mb-3">
                            <label for="password-field" class="form-label fw-bold">Password</label>
                            <input type="password" class="form-control" id="password-field">
                        </div>

                        <div class="form-group mb-3">
                            <label for="confirm-password-field" class="form-label fw-bold">Confirm password</label>
                            <input type="password" class="form-control" id="confirm-password-field">
                        </div>

                        <input type="submit" class="btn btn-sm btn-primary float-end" value="Register">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<?= $this->endSection(); ?>