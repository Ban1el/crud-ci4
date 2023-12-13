<?= $this->extend('layouts/frontend'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row my-5 d-flex justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Student
                        <a href="<?= base_url('students/dashboard') ?>" class="btn btn-sm btn-danger float-end">Back</a>
                    </h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('students/modify_student/' . $studentData['student_id']); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group mb-3">
                            <label for="id-field" class="form-label">ID</label>
                            <input type="text" class="form-control" id="id-field" value="<?= $studentData['student_id'] ?>">
                            <strong class="text-danger">
                                <?php
                                if (isset($validation)) {
                                    if ($validation->hasError('student_id')) {
                                        echo $validation->getError('student_id');
                                    }
                                }
                                ?>
                            </strong>
                        </div>

                        <div class="form-group mb-3">
                            <label for="name-field" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name-field" name="student_name" value="<?= $studentData['student_name'] ?>">
                            <strong class="text-danger">
                                <?php
                                if (isset($validation)) {
                                    if ($validation->hasError('student_name')) {
                                        echo $validation->getError('student_name');
                                    }
                                }
                                ?>
                            </strong>
                        </div>

                        <div class="form-group mb-3">
                            <label for="mobile-field" class="form-label">Mobile No.</label>
                            <input type="text" class="form-control" id="mobile-field" name="student_mobile" value="<?= $studentData['student_mobile'] ?>">
                            <strong class=" text-danger" value="<?= set_value('student_mobile'); ?>">
                                <?php
                                if (isset($validation)) {
                                    if ($validation->hasError('student_mobile')) {
                                        echo $validation->getError('student_mobile');
                                    }
                                }
                                ?>
                            </strong>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email-field" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email-field" name="student_email" value="<?= $studentData['student_email'] ?>">
                            <strong class="text-danger">
                                <?php
                                if (isset($validation)) {
                                    if ($validation->hasError('student_email')) {
                                        echo $validation->getError('student_email');
                                    }
                                }
                                ?>
                            </strong>
                        </div>

                        <div class="form-group mb-3">
                            <label for="course-field" class="form-label">Course</label>
                            <input type="text" class="form-control" id="course-field" name="student_course" value="<?= $studentData['student_course'] ?>">
                            <strong class="text-danger">
                                <?php
                                if (isset($validation)) {
                                    if ($validation->hasError('student_course')) {
                                        echo $validation->getError('student_course');
                                    }
                                }
                                ?>
                            </strong>
                        </div>

                        <div class="form-group mb-3">
                            <label for="section-field" class="form-label">Section</label>
                            <input type="text" class="form-control" id="section-field" name="student_section" value="<?= $studentData['student_section'] ?>">
                            <strong class="text-danger">
                                <?php
                                if (isset($validation)) {
                                    if ($validation->hasError('student_section')) {
                                        echo $validation->getError('student_section');
                                    }
                                }
                                ?>
                            </strong>
                        </div>

                        <div class="form-group mb-3">
                            <label for="year-level-field" class="form-label">Year level</label>
                            <input type="text" class="form-control" id="year-level-field" name="student_year_level" value="<?= $studentData['student_year_level'] ?>">
                            <strong class="text-danger">
                                <?php
                                if (isset($validation)) {
                                    if ($validation->hasError('student_year_level')) {
                                        echo $validation->getError('student_year_level');
                                    }
                                }
                                ?>
                            </strong>
                        </div>

                        <div class="form-group mb-3">
                            <div class="d-flex justify-content-center mb-3">
                                <img src="<?= !empty($studentData['student_profile_picture']) ? base_url('public/assets/img/students_profile_picture/' . $studentData['student_profile_picture']) : base_url('public/assets/img/students_profile_picture/placeholder.jpg'); ?>" alt="profile-picture" class="rounded-circle img-fluid" id="profile-picture-preview" style="width: 200px; height: 200px; object-fit: cover;">
                            </div>

                            <input type="file" class="form-control" id="img-input" name="student_profile_picture">
                            <strong class="text-danger">
                                <?php
                                if (isset($validation)) {
                                    if ($validation->hasError('student_profile_picture')) {
                                        echo $validation->getError('student_profile_picture');
                                    }
                                }
                                ?>
                            </strong>
                        </div>

                        <input type="submit" class="btn btn-sm btn-success float-end" value="Modify Student">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>
    <?= $this->section('scripts'); ?>
    <script>
        $(document).ready(function() {

            $('#img-input').change(function() {

                let file = new FileReader();

                file.onload = function(e) {
                    $('#profile-picture-preview').attr('src', e.target.result);
                }

                file.readAsDataURL(this.files[0]);
            });
        });
    </script>
    <?= $this->endSection(); ?>