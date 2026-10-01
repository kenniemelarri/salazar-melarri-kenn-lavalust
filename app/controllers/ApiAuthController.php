<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiAuthController extends Controller
{
    public function login()
    {
        $this->call->library('api');
        $this->call->database();
        $this->call->model('UsersModel');

        $this->api->require_method('POST');

        $data = $this->api->body();

        $username = trim($data['username'] ?? '');
        $password = $data['password'] ?? '';

        if ($username === '' || $password === '') {
            $this->api->respond_error(
                'Username and password are required.',
                422
            );
        }

        $user = $this->UsersModel->find_by('username', $username);

        if (
            !$user ||
            (int) $user['is_active'] !== 1 ||
            !password_verify($password, $user['password'])
        ) {
            $this->api->respond_error(
                'Invalid username or password.',
                401
            );
        }

        $tokens = $this->api->issue_tokens([
            'id' => $user['id'],
            'role' => $user['role'],
            'scopes' => ['read', 'write']
        ]);

        $this->api->respond([
            'success' => true,
            'message' => 'Login successful.',
            'user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role']
            ],
            'tokens' => $tokens
        ]);
    }
}
