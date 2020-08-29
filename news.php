<?php include_once 'config/init.php'; ?>

<?php
    if(isset($_GET['news'])) {
        $id = $_GET['news'];

        $user = new User;
        $news = new News;

        $news -> addView($id);

        include_once 'helpers/log_in_out.php';

        $template = new Template('./templates/news_checkout.php');

        $template -> news = $news -> displayNews($id);
        $template -> contributorsList = $news -> getContributors();

        echo $template;
    } else {
        redirect('index.php', 'Something went wrong', 'error');
    }
?>