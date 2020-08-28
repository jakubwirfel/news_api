<?php include_once 'config/init.php'; ?>

<?php
    $news = new News;
    $user = new User;

    $id = $_GET['id'];
    if($news -> checkNewsToUser($id)) {
        if(isset($_POST['update'])) {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $path = trim($_POST['path']);
            $image = $_FILES['image'];

            $data = array();
            $data['title'] = $title;
            $data['content'] =  $content;

            if($news -> editNews($data, $image, $path)) {
                redirect('index.php', 'You update news', 'success');
            } else {
                redirect('index.php', 'Something went wrong', 'error');
            }
        }

        $template = new Template('./templates/edit_news.php');

        $template -> news = $news -> getNewsToEdit($id);

        echo $template;
    } else {
        redirect('index.php', 'Login first', 'error');
    }
?>