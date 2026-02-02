<?php
class AspirationModel {
    private $db;
    public function __construct() { $this->db = new Database; }

    public function getAllAspirations() {
        $this->db->query("SELECT aspirations.*, users.full_name FROM aspirations JOIN users ON aspirations.user_id = users.id ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    public function getUserAspirations($user_id) {
        $this->db->query("SELECT * FROM aspirations WHERE user_id = :uid ORDER BY created_at DESC");
        $this->db->bind('uid', $user_id);
        return $this->db->resultSet();
    }

    public function create($data) {
        $this->db->query("INSERT INTO aspirations (user_id, title, description, category) VALUES (:uid, :title, :desc, :cat)");
        $this->db->bind('uid', $_SESSION['user_id']);
        $this->db->bind('title', $data['title']);
        $this->db->bind('desc', $data['description']);
        $this->db->bind('cat', $data['category']);
        return $this->db->execute() ? $this->db->lastInsertId() : false;
    }

    public function updateStatus($id, $status) {
        $this->db->query("UPDATE aspirations SET status = :status WHERE id = :id");
        $this->db->bind('status', $status);
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM aspirations WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
    
    public function getById($id) {
        $this->db->query("SELECT * FROM aspirations WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function sendToInbox($user_id, $subject, $message) {
        $this->db->query("INSERT INTO inbox (user_id, subject, message) VALUES (:uid, :sub, :msg)");
        $this->db->bind('uid', $user_id);
        $this->db->bind('sub', $subject);
        $this->db->bind('msg', $message);
        return $this->db->execute();
    }
}