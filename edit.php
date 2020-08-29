<?php include_once 'config/init.php'; ?>

<?php
    $news = new News;
    $user = new User;

    include_once 'helpers/log_in_out.php';

    $id = $_GET['id'];

    if($news -> checkNewsToUser($id)) {

        if(isset($_POST['update'])) {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);

            if($news -> editNews($title, $content, $id)) {
                redirect("profile.php?name={$_SESSION['username']}", 'Changes has been made', 'succes');
            } else {
                redirect("profile.php?name={$_SESSION['username']}", 'Something went wrong', 'error');
            }
        }

        $template = new Template('./templates/edit_news.php');

        $template -> news = $news -> getNewsToEdit($id);

        echo $template;
    } else {
        redirect('index.php', 'Invalid user', 'error');
    }
?>