<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class StudentController extends BaseController
{
    protected $studentModel;
    protected $session;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $data = [
            'title' => 'Student Dashboard',
            'student' => $this->studentModel->findAll(),
        ];

        return view("students/dashboard",  $data);
    }

    public function create_student()
    {
        helper('form');
        $generated_id = $this->studentModel->generate_student_id();

        $data = [
            'title' => 'Create Student',
            'student_id' => $generated_id,
        ];

        $this->session->set('generated_student_id', $generated_id);

        return view("students/create",  $data);
    }

    public function add_student()
    {
        if ($this->request->is('post')) {
            $file = $this->request->getFile('student_profile_picture');

            $rules = [
                'student_name' => 'required',
                'student_mobile' => 'required|numeric|min_length[11]|max_length[11]',
                'student_email' => 'required|valid_email',
                'student_course' => 'required',
                'student_section' => 'required',
                'student_year_level' => 'required',
                'student_profile_picture' => 'permit_empty|uploaded[student_profile_picture]|max_size[student_profile_picture,2048]|is_image[student_profile_picture]|ext_in[student_profile_picture,png,jpg,jpeg]',
            ];

            $messages = [
                'student_id' => ['is_not_tampered' => 'ID tampered'],
            ];

            if (!$this->validate($rules,  $messages)) {

                helper('form');
                $generated_id = $this->studentModel->generate_student_id();
                $this->session->set('generated_student_id', $generated_id);

                $data = [
                    'title' => 'Create Student',
                    'student_id' => $generated_id,
                    'validation' => $this->validator,
                ];

                return view("students/create",  $data);
            } else {
                $imageName = null;

                if ($file->isValid() && !$file->hasMoved()) {
                    $imageName = $file->getRandomName();
                    $file->move('public/assets/img/students_profile_picture/', $imageName);
                }

                $data = [
                    'student_id' => $this->request->getPost('student_id'),
                    'student_name' => $this->request->getPost('student_name'),
                    'student_mobile' => $this->request->getPost('student_mobile'),
                    'student_email' => $this->request->getPost('student_email'),
                    'student_course' => $this->request->getPost('student_course'),
                    'student_section' => $this->request->getPost('student_section'),
                    'student_year_level' => $this->request->getPost('student_year_level'),
                    'student_profile_picture' => $imageName,
                ];

                $this->studentModel->insert($data);

                $this->session->remove('generated_student_id');

                return redirect('students/dashboard')->with('status', 'Student Added!');
            }
        }
    }

    public function edit_student($id)
    {
        helper('form');

        $student_data = $this->studentModel->find($id);

        $data = [
            'title' => 'Edit Student',
            'studentData' => $student_data,
        ];

        return view("students/edit",  $data);
    }

    public function modify_student($id)
    {
        $student = $this->studentModel->find($id);
        $old_img_name = $student['student_profile_picture'];
        $file = $this->request->getFile('student_profile_picture');

        $rules = [
            'student_name' => 'required',
            'student_mobile' => 'required|numeric|min_length[11]|max_length[11]',
            'student_email' => 'required|valid_email',
            'student_course' => 'required',
            'student_section' => 'required',
            'student_year_level' => 'required',
            'student_profile_picture' => 'permit_empty|uploaded[student_profile_picture]|max_size[student_profile_picture,2048]|is_image[student_profile_picture]|ext_in[student_profile_picture,png,jpg,jpeg]',
        ];

        if (!$this->validate($rules)) {
            helper('form');

            $data = [
                'title' => 'Edit Student',
                'studentData' => $student,
                'validation' => $this->validator,
            ];

            return view("students/edit",  $data);
        } else {

            if ($file->isValid() && !$file->hasMoved()) {

                if (file_exists("public/assets/img/students_profile_picture/" . $old_img_name) && $old_img_name != null) {
                    unlink("public/assets/img/students_profile_picture/" . $old_img_name);
                }

                $imageName = $file->getRandomName();

                $file->move("public/assets/img/students_profile_picture/", $imageName);
            } else {
                $imageName = $old_img_name;
            }

            $data = [
                'student_name' => $this->request->getPost('student_name'),
                'student_mobile' => $this->request->getPost('student_mobile'),
                'student_email' => $this->request->getPost('student_email'),
                'student_course' => $this->request->getPost('student_course'),
                'student_section' => $this->request->getPost('student_section'),
                'student_year_level' => $this->request->getPost('student_year_level'),
                'student_profile_picture' => $imageName,
            ];

            $this->studentModel->update($student['student_id'], $data);

            return redirect('students/dashboard')->with('status', 'Student Modified!');
        }
    }

    public function delete_Student($id)
    {
        $student = $this->studentModel->find($id);
        $profile_picture = $student['student_profile_picture'];

        if (file_exists("public/assets/img/students_profile_picture/" . $profile_picture) && $profile_picture != null) {
            unlink("public/assets/img/students_profile_picture/" . $profile_picture);
        }

        $this->studentModel->delete($id);

        return redirect('students/dashboard')->with('status', 'Student Deleted!');
    }

    public function export_to_excel()
    {
        $student = $this->studentModel->findAll();
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();

        $activeWorksheet->setCellValue('A1', 'Student ID');
        $activeWorksheet->setCellValue('B1', 'Student name');
        $activeWorksheet->setCellValue('C1', 'Student email');
        $activeWorksheet->setCellValue('D1', 'Student course');
        $activeWorksheet->setCellValue('E1', 'Student section');
        $activeWorksheet->setCellValue('F1', 'Student year level');
        $activeWorksheet->setCellValue('G1', 'Date Created');
        $count = 2;

        foreach ($student as $row) {
            $activeWorksheet->setCellValue('A' . $count, $row['student_id']);
            $activeWorksheet->setCellValue('B' . $count, $row['student_name']);
            $activeWorksheet->setCellValue('C' . $count, $row['student_email']);
            $activeWorksheet->setCellValue('D' . $count, $row['student_course']);
            $activeWorksheet->setCellValue('E' . $count, $row['student_section']);
            $activeWorksheet->setCellValue('F' . $count, $row['student_year_level']);
            $activeWorksheet->setCellValue('G' . $count, $row['date_created']);
        }

        $filename = 'sample-' . time() . '.xlsx';

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');


        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
