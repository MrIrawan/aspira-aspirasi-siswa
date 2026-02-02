<?php
class MessageModel {
    private $db;
    public function __construct() { $this->db = new Database; }

    public function getMessages($aspiration_id) {
        $this->db->query("SELECT messages.*, users.full_name, users.role FROM messages JOIN users ON messages.sender_id = users.id WHERE aspiration_id = :aid ORDER BY created_at ASC");
        $this->db->bind('aid', $aspiration_id);
        return $this->db->resultSet();
    }

    public function send($data) {
        $query = "INSERT INTO messages (aspiration_id, sender_id, message, image_path) VALUES (:aid, :sid, :msg, :img)";
        $this->db->query($query);
        $this->db->bind('aid', $data['aspiration_id']);
        $this->db->bind('sid', $_SESSION['user_id']);
        $this->db->bind('msg', $data['message']);
        $this->db->bind('img', $data['image']);
        return $this->db->execute();
    }
}