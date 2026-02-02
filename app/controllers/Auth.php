<?php
class Auth extends Controller {
    public function index() {
        $this->view('auth/login');
    }
    
    public function login() {
        // Logic login sederhana
        if(isset($_POST['username'])) {
            $user = $this->model('UserModel')->getUserByUsername($_POST['username']);
            if($user && password_verify($_POST['password'], $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['full_name'];
                header('Location: ' . BASEURL . '/' . $user['role']);
            } else {
                header('Location: ' . BASEURL); // Gagal
            }
        }
    }
    
    public function logout() {
        session_start(); session_destroy(); header('Location: ' . BASEURL);
    }
}