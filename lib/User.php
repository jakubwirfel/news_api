<?php
include_once './helpers/validators.php';

class User extends Validators {
    protected $db;
    public function __construct() {
        $this -> db = new Database;
    }

    public function register($data) {

        $this -> db -> query("INSERT INTO users (name, email, password)
        VALUES (:name, :email, :password)");
        $password = md5($data['password']);

        $this -> db -> bind(':name', $data['username']);
        $this -> db -> bind(':email', $data['email']);
        $this -> db -> bind(':password', $password);

        if($this -> db -> execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($data) {
        $this -> db -> query("SELECT id, name, email FROM users WHERE name = :name AND password = :pwd");
        $pass= md5($data['password']);

        $this -> db -> bind(':name', $data['user']);
        $this -> db -> bind(':pwd', $pass);

        $results = $this -> db -> resultSet();
        $numRows = $this -> db -> rowCount();
        if($numRows == 1) {
            foreach($results as $row) {
                $_SESSION['userId'] = $row -> id;
                $_SESSION['username'] = $row -> name;
                $_SESSION['confirm'] = "start";
            }
            return true;
        } else {
            return false;
        }
    }

    public function logout() {

        session_destroy();
        unset($_SESSION['userId']);
        unset($_SESSION['username']);
        unset($_SESSION['confirm']);

        if (!isset($_SESSION['confirm']) && !isset($_SESSION['username']) && !isset($_SESSION['userId'])) {
            return true;
        } else {
            return false;
        }
    }
}
