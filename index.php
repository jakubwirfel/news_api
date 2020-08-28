<?php include_once 'config/init.php'; ?>

<?php
    $user = new User;
    $news = new News;

    include_once 'helpers/log_in_out.php';

    $template = new Template('./templates/frontpage.php');

    $template -> newsList = $news -> displayNewsList();

    echo $template;
?>