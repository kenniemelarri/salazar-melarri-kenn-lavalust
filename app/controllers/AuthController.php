<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function login()
    {
        $this->start_session();

        if ($this->is_authenticated()) {
            redirect('products');
            return;
        }

        $error = null;

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {

            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            $this->call->database();
            $this->call->model('UsersModel');

            $user = $this->UsersModel->find_by('username', $username);

            if (
                $user &&
                (int) $user['is_active'] === 1 &&
                password_verify($password, $user['password'])
            ) {

                session_regenerate_id(true);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                redirect('products');
                return;
            }

            $error = 'Invalid username or password.';
        }

        $this->call->view('login', ['error' => $error]);
    }


    public function register()
    {
        $error = null;

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {

            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (
                $username === '' ||
                !filter_var($email, FILTER_VALIDATE_EMAIL) ||
                strlen($password) < 8
            ) {
                $error = 'Please enter a username, valid email, and password of at least 8 characters.';
            } else {

                $this->call->database();
                $this->call->model('UsersModel');

                $existingUsername = $this->UsersModel->find_by(
                    'username',
                    $username
                );

                $existingEmail = $this->UsersModel->find_by(
                    'email',
                    $email
                );

                if ($existingUsername || $existingEmail) {

                    $error = 'That username or email is already registered.';

                } else {

                    $this->UsersModel->insert([
                        'username' => $username,
                        'email' => $email,
                        'password' => password_hash(
                            $password,
                            PASSWORD_DEFAULT
                        ),
                        'role' => 'user',
                        'is_active' => 1,
                    ]);

                    redirect('login');
                    return;
                }
            }
        }

        $this->call->view('register', ['error' => $error]);
    }


    public function logout()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $_SESSION = [];
        session_destroy();

        redirect('login');
    }


    private function is_authenticated()
    {
        return session_status() === PHP_SESSION_ACTIVE
            && !empty($_SESSION['user_id']);
    }


    private function start_session()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}