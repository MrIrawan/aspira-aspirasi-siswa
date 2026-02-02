<?php
class Chat extends Controller {
    public function __construct() { session_start(); }

    public function room($id) {
        $data['aspiration'] = $this->model('AspirationModel')->getById($id);
        // Validasi akses (User hanya boleh akses room miliknya)
        if($_SESSION['role'] == 'student' && $data['aspiration']['user_id'] != $_SESSION['user_id']) {
            header('Location: ' . BASEURL . '/student');
        }

        $this->view('templates/header', ['title' => 'Room Chat']);
        $this->view('chat/room', $data);
        $this->view('templates/footer');
    }

    // API untuk AJAX fetch messages
    public function getMessages($id) {
        $messages = $this->model('MessageModel')->getMessages($id);
        echo json_encode($messages);
    }

    public function send() {
        $data = [
            'aspiration_id' => $_POST['aspiration_id'],
            'message' => $_POST['message'],
            'image' => null
        ];

        // Handle Image Upload
        if(!empty($_FILES['image']['name'])) {
            $target = '../public/uploads/' . time() . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $data['image'] = 'uploads/' . basename($target);
        }

        $this->model('MessageModel')->send($data);
    }
}