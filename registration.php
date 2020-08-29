<?php include_once 'config/init.php'; ?>

<?php
    $user = new User;

    if(isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password_1 = trim($_POST['password_1']);
        $password_2 = trim($_POST['password_2']);
        $date = date("Y-m-d");
        $user -> usernameValidation($username);
        $user -> emailValidation($email);
        $user -> passwordValidation($password_1, $password_2);
        if ($valid_username && $valid_email && $valid_password) {
            $data = array();
            $data['username'] = $username;
            $data['email'] =  $email;
            $data['password'] = $password_1;
            if($user -> register($data)) {
                redirect('index.php', 'You are registered', 'success');
            } else {
                redirect('index.php', 'Something went wrong', 'error');
            }
        }
    }

    include_once 'helpers/log_in_out.php';

    $template = new Template('./templates/signup.php');

    echo $template;
?>