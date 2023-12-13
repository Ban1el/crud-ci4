<?= $this->extend('layouts/frontend'); ?>
<?= $this->section('content'); ?>

<?= $this->include('inc/navbar'); ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-3">Students</h5>
            <div>
                <form action="<?= base_url('students/export_to_excel') ?>" method="post">
                    <a href="<?= base_url("students/create_student") ?>" class="btn btn-sm btn-primary">Add students</a>
                    <?= csrf_field() ?>
                    <input type="submit" class="btn btn-sm btn-success float-end" value="Export">
                </form>
            </div>

            <?php if (!empty(session()->getFlashdata('status'))) : ?>
                <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                    <strong>Hey</strong> <?= session()->getFlashdata('status') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>

        <div class="card-body">
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Mobile No.</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Section</th>
                        <th>Year Level</th>
                        <th>Profile Picture</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($student)) : ?>
                        <?php foreach ($student as $row) : ?>
                            <tr>
                                <td><?= $row['student_id'] ?></td>
                                <td><?= $row['student_name'] ?></td>
                                <td><?= $row['student_mobile'] ?></td>
                                <td><?= $row['student_email'] ?></td>
                                <td><?= $row['student_course'] ?></td>
                                <td><?= $row['student_section'] ?></td>
                                <td><?= $row['student_year_level'] ?></td>
                                <td>
                                    <?php if (!empty($row['student_profile_picture'])) : ?>
                                        <img src="<?= base_url('public/assets/img/students_profile_picture/' . $row['student_profile_picture']) ?>" alt="profile-picture" style="width: 100px; height: 100px; object-fit: cover;">
                                    <?php else : ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('students/edit_student/' . $row['student_id']) ?>" class="btn btn-sm btn-success">Edit</a>
                                    <form action="<?= base_url('students/delete_student/' . $row['student_id']) ?>" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <?= csrf_field() ?>
                                        <input type="submit" class="btn btn-sm btn-danger delete-btn" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Mobile No.</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Section</th>
                        <th>Year Level</th>
                        <th>Profile Picture</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteConfirmModalLabel">Are you sure?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center gap-3">
                <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-sm btn-danger" id="confirm-delete">Delete</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    $(document).ready(function() {
        new DataTable('#example');

        $('.delete-btn').click(function(e) {
            e.preventDefault();

            let form = $(this).closest('form');

            $('#deleteConfirmModal').modal('show');

            $('#confirm-delete').click(function() {
                form.submit();
            });
        });
    });
</script>
<?= $this->endSection(); ?>