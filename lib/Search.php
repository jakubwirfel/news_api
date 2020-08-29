<?php
include_once '../config/config.php';
include_once 'Database.php';

class Search {
    protected $db;

    public function __construct() {
        $this -> db = new Database;
    }

    public function userSearch($term, $uName) {
        $this -> db -> query("SELECT u.id, u.name FROM users u WHERE u.name LIKE :search AND u.name NOT LIKE :uName");
        $search = $term . "%";
        // Bind data
        $this -> db -> bind(':search', $search);
        $this -> db -> bind(':uName',  $uName);

        $results = $this -> db -> resultSet();
        $numRows = $this -> db -> rowCount();

        if($numRows > 0) {
            foreach($results as $row) {
                echo "<div><p>". $row -> name ."</p><span hidden id='id'>". $row -> id ."</span></div>";
            }
        } else {
            echo "<p>No matches found</p>";
        }
    }
}