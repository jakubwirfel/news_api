<?php include_once 'config/init.php'; ?>

<?php
    $user = new User;
    $news = new News;

    include_once 'helpers/log_in_out.php';

    $template = new Template('./templates/frontpage.php');

    $template -> bestsNews = $news -> getBestNews();
    $template -> bestsUsers = $news -> getBestUsers();

    $template -> newsList = $news -> displayNewsList();

    echo $template;
?>