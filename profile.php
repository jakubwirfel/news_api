<?php include_once 'config/init.php'; ?>

<?php
    $name = $_GET['name'];

    $user = new User;
    $news = new News;

    include_once 'helpers/log_in_out.php';

    $template = new Template('./templates/user_profile.php');

    $template -> newsList = $news -> displayUserNews($name);

    echo $template;
?>