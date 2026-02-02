<?php
class UserModel {
    private $db;
    public function __construct() { $this->db = new Database; }

    public function getUserByUsername($username) {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind('username', $username);
        return $this->single();
    }

    public function getInbox($user_id) {
        $this->db->query("SELECT * FROM inbox WHERE user_id = :uid ORDER BY created_at DESC");
        $this->db->bind('uid', $user_id);
        return $this->db->resultSet();
    }
    
    // Helper untuk Single result karena Database.php kita butuh ini
    private function single() { return $this->db->single(); }
}