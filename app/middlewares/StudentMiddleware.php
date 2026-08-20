<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware
{
    public function handle(Closure $next)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (($_SESSION['student_access'] ?? false) !== true || ($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            $_SESSION['student_warning'] = 'Profile access is available only through the Profile button on the student home page.';
            redirect('student');
            exit;
        }

        return $next();
    }
}