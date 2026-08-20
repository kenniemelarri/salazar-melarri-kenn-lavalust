<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    private function student_data()
    {
        return [
            'student_id' => 'MCC2024-00180',
            'name' => 'Melarri Kenn Salazar',
            'course' => 'BS Information Technology',
            'year' => '3rd Year',
            'section' => '3F4',
            'email' => 'melarri.salazar926@gmail.com',
            'focus' => 'Passionate about learning, creating, and turning ideas into meaningful digital experiences.',
        ];
    }

    public function index()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $_SESSION['student_access'] = true;

        $request_path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET' && preg_match('#/student/profile/?$#', $request_path)) {
            $_SESSION['student_warning'] = 'Profile access is available only through the Profile button on the student home page.';
        }

        $this->call->view('student_home', ['student' => $this->student_data()]);
    }

    public function profile()
    {
        $this->call->view('student_profile', ['student' => $this->student_data()]);
    }
}