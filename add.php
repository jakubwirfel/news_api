<?php include_once 'config/init.php'; ?>

<?php
    if(isset( $_SESSION['userId']) && isset($_SESSION['confirm']) && isset($_SESSION['username'])) {
        $news = new News;

        if(isset($_POST['add'])) {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $image = $_FILES['image'];

            $data = array();
            $data['title'] = $title;
            $data['content'] =  $content;

            if($news -> addNews($data, $image)) {
                redirect('index.php', 'You add news', 'success');
            } else {
                redirect('index.php', 'Something went wrong', 'error');
            }
        }

        $template = new Template('./templates/add_news.php');

        echo $template;
    } else {
        redirect('index.php', 'You must login', 'error');
    }
?>