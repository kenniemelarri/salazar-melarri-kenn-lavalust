<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware
{
    public function handle(Closure $next)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $referrer = $_SERVER['HTTP_REFERER'] ?? '';
        $referrer_path = parse_url($referrer, PHP_URL_PATH) ?: '';
        $came_from_student_home = in_array(rtrim($referrer_path, '/'), ['', '/index.php', '/index.php/student'], true);

        if (($_SESSION['student_access'] ?? false) !== true || !$came_from_student_home) {
            redirect('student');
            exit;
        }

        return $next();
    }
}