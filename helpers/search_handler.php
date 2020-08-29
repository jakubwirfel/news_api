<?php
require_once "../lib/Search.php";

if(isset($_REQUEST["term"])){
    $search = new Search();
    $term = $_REQUEST["term"];
    $uName = $_REQUEST["uName"];
    $result = $search -> userSearch($term, $uName);
}