<?php include_once 'config/init.php'; ?>

<?php
    $user = new User;

    include_once 'helpers/log_in_out.php';

    if(isset($_GET['name'])) {

        $name = $_GET['name'];

        $news = new News;

        $template = new Template('./templates/user_profile.php');

        $template -> newsList = $news -> displayUserNews($name);

        echo $template;
    } else {
        redirect('index.php', 'Choose a profile first', 'error');
    }
?>