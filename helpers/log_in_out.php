<?php
if(isset($_POST['login'])) {
    $username = $_POST['user'];
    $password = $_POST['password'];

    if (isset($username) && isset($password)) {
        $data = array();
        $data['user'] = $username;
        $data['password'] = $password;

        if($user -> login($data)) {
            redirect($_SERVER['PHP_SELF'], 'You login', 'success');
        } else {
            redirect($_SERVER['PHP_SELF'], 'Incorrect username or psassword', 'error');
        }
    } else {
        redirect($_SERVER['PHP_SELF'], 'Username and password are required', 'error');
    }
}

if (isset($_GET['logout'])) {
    if ($user -> logout()) {
        redirect('index.php', 'You logout', 'success');
    } else {
        redirect('index.php', 'Something went wrong', 'error');
    }
}