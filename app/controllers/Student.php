<?php
class Student extends Controller {
    public function __construct() {
        session_start();
        if($_SESSION['role'] != 'student') header('Location: ' . BASEURL);
    }

    public function index() {
        $data['aspirations'] = $this->model('AspirationModel')->getUserAspirations($_SESSION['user_id']);
        $this->view('templates/header', ['title' => 'Dashboard Siswa']);
        $this->view('student/index', $data);
        $this->view('templates/footer');
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->model('AspirationModel')->create($_POST)) {
                header('Location: ' . BASEURL . '/student');
            }
        }
    }
    
    public function inbox() {
         $data['inbox'] = $this->model('UserModel')->getInbox($_SESSION['user_id']);
         $this->view('templates/header');
         $this->view('student/inbox', $data);
         $this->view('templates/footer');
    }
}