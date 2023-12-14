<?= $this->extend('layouts/frontend'); ?>
<?= $this->section('content'); ?>

<?= $this->include('inc/navbar'); ?>

<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5>Register Account</h5>

                    <?php if (!empty(session()->getFlashdata('status'))) : ?>

                        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                            <strong>Hey</strong> <?= session()->getFlashdata('status') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    <?php endif; ?>
                </div>

                <div class="card-body">
                    <form action="<?= base_url('register_user') ?>" method="post">

                        <?= csrf_field(); ?>

                        <div class="form-group mb-3">
                            <label for="username-field" class="form-label fw-bold">Username</label>
                            <input type="text" class="form-control" id="username-field" name="username" value="<?= set_value('username'); ?>">
                            <strong class="text-danger">
                                <?php if (isset($validation)) : ?>
                                    <?php if ($validation->hasError('username')) : ?>
                                        <?= $validation->getError('username'); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </strong>
                        </div>

                        <div class="form-group mb-3">
                            <label for="name-field" class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control" id="name-field" name="name" value="<?= set_value('name'); ?>">
                            <strong class="text-danger">
                                <?php if (isset($validation)) : ?>
                                    <?php if ($validation->hasError('name')) : ?>
                                        <?= $validation->getError('name'); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </strong>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email-field" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="email-field" name="email" value="<?= set_value('email'); ?>">
                            <strong class="text-danger">
                                <?php if (isset($validation)) : ?>
                                    <?php if ($validation->hasError('email')) : ?>
                                        <?= $validation->getError('email'); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </strong>
                        </div>

                        <div class="form-group mb-3">
                            <label for="mobile-field" class="form-label fw-bold">Mobile No.</label>
                            <input type="text" class="form-control" id="mobile-field" name="mobile" value="<?= set_value('mobile'); ?>">
                            <strong class="text-danger">
                                <?php if (isset($validation)) : ?>
                                    <?php if ($validation->hasError('mobile')) : ?>
                                        <?= $validation->getError('mobile'); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </strong>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password-field" class="form-label fw-bold">Password</label>
                            <input type="password" class="form-control" id="password-field" name="password">
                            <strong class="text-danger">
                                <?php if (isset($validation)) : ?>
                                    <?php if ($validation->hasError('password')) : ?>
                                        <?= $validation->getError('password'); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </strong>
                        </div>

                        <div class="form-group mb-3">
                            <label for="confirm-password-field" class="form-label fw-bold">Confirm password</label>
                            <input type="password" class="form-control" id="confirm-password-field" name="conf-password">
                            <strong class="text-danger">
                                <?php if (isset($validation)) : ?>
                                    <?php if ($validation->hasError('conf-password')) : ?>
                                        <?= $validation->getError('conf-password'); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </strong>
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