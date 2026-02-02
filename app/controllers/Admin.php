<?php
class Admin extends Controller {
    public function __construct() {
        session_start();
        if($_SESSION['role'] != 'admin') header('Location: ' . BASEURL);
    }

    public function index() {
        $data['aspirations'] = $this->model('AspirationModel')->getAllAspirations();
        $this->view('templates/header', ['title' => 'Admin Dashboard']);
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }

    public function updateStatus() {
        if($this->model('AspirationModel')->updateStatus($_POST['id'], $_POST['status'])) {
            header('Location: ' . BASEURL . '/admin');
        }
    }

    public function deleteWithReason() {
        $id = $_POST['aspiration_id'];
        $userId = $_POST['user_id'];
        $reason = $_POST['reason'];

        // 1. Kirim alasan ke inbox siswa
        $this->model('AspirationModel')->sendToInbox($userId, "Aspirasi Dihapus", $reason);
        // 2. Hapus aspirasi & chatnya
        $this->model('AspirationModel')->delete($id);
        
        header('Location: ' . BASEURL . '/admin');
    }
}