<?php

class News {
    protected $db;

    private $_suporttedFormats = ['image/png','image/jpeg','image/jpg'];

    public function __construct() {
        $this -> db = new Database;
    }

    public function addNews($data, $image) {
        if (in_array($image['type'], $this->_suporttedFormats)) {
            move_uploaded_file($image['tmp_name'],'./public/news_img/'. $image['name']);
            $imagePath = './public/news_img/'. $image['name'];
            $_SESSION['path'] = $imagePath;
            $imageName = $image['name'];

            $this -> db -> query("INSERT INTO news_images (name, alt, src) VALUES (:name, :alt, :src)");

            $this -> db -> bind(':name', $imageName);
            $this -> db -> bind(':alt', $imageName);
            $this -> db -> bind(':src', $imagePath);

            if($this -> db -> execute()) {
                $this -> db -> query("SELECT id FROM news_images WHERE src = :src");

                $this -> db -> bind(':src', $imagePath);

                $row = $this -> db -> single();

                $_SESSION['imageId'] =  $row -> id;

                $this -> db -> query("INSERT INTO news (title, content, creation_date, views, image_id) VALUES (:title, :content, :date, :views, :img_id)");

                $this -> db -> bind(':title', $data['title']);
                $this -> db -> bind(':content', $data['content']);
                $this -> db -> bind(':date', date("Y-m-d"));
                $this -> db -> bind(':views', 0);
                $this -> db -> bind(':img_id', $_SESSION['imageId']);

                if($this -> db -> execute()) {
                    $this -> db -> query("SELECT id FROM news WHERE title = :title AND content = :content");

                    $this -> db -> bind(':title', $data['title']);
                    $this -> db -> bind(':content', $data['content']);

                    $row = $this -> db -> single();

                    $_SESSION['newsId'] =  $row -> id;

                    $this -> db -> query("INSERT INTO users_news (user_id, news_id) VALUES (:user_id, :news_id)");

                    $this -> db -> bind(':user_id', $_SESSION['userId']);
                    $this -> db -> bind(':news_id', $_SESSION['newsId']);

                    if($this -> db -> execute()) {
                        unset($_SESSION['imageId']);
                        unset($_SESSION['newsId']);
                        return true;
                    } else {
                        $this -> db -> query("DELETE FROM news WHERE id = :id");
                        $this -> db -> bind(':id', $_SESSION['newsId']);
                        $this -> db -> execute();
                        $this -> db -> query("DELETE FROM news_images WHERE id = :id");
                        $this -> db -> bind(':id', $_SESSION['imageId']);
                        $this -> db -> execute();
                        return false;
                    }

                } else {
                    $this -> db -> query("DELETE FROM news_images WHERE id = :id");
                    $this -> db -> bind(':id', $_SESSION['imageId']);
                    $this -> db -> execute();
                    return false;
                }

            } else {
                unlink($_SESSION['path']);
                unset($_SESSION['path']);
                return false;
            }
        }
    }

    public function displayNewsList() {
        $this -> db -> query("SELECT n.id, n.title, n.content, n.creation_date, n.views, i.alt, i.src, u.name
                                FROM news n, news_images i, users u, users_news un
                                WHERE n.image_id = i.id AND n.id = un.news_id AND u.id = un.user_id
                                ORDER BY n.id DESC");

        $results = $this -> db -> resultSet();

        return $results;
    }

    public function displayNews($id) {
        $this -> db -> query("SELECT n.id, n.title, n.content, n.creation_date, n.views, i.alt, i.src, u.name
                                FROM news n, news_images i, users u, users_news un
                                WHERE n.image_id = i.id AND n.id = un.news_id AND n.id = :id");

        $this -> db -> bind(':id', $id);

        $row = $this -> db -> single();

        return $row;
    }

    public function  displayUserNews($name) {
        $this -> db -> query("SELECT n.id, n.title, n.content, n.creation_date, n.views, i.alt, i.src, u.name
                                FROM news n, news_images i, users u, users_news un
                                WHERE n.image_id = i.id AND n.id = un.news_id AND u.name = :name");

        $this -> db -> bind(':name', $name);

        $results = $this -> db -> resultSet();

        return $results;
    }

    public function addView($id) {
        $this -> db -> query("SELECT views FROM news WHERE id = :id");
        $this -> db -> bind(':id', $id);
        $row = $this -> db -> single();
        $count = $row -> views;

        $this -> db -> query("UPDATE news SET views = :views WHERE id = :id");
        $this -> db -> bind(':views', $count+1);
        $this -> db -> bind(':id', $id);
        $this -> db -> execute();
    }

    public function checkNewsToUser($id) {
        if(isset($_SESSION['confirm']) && $_SESSION['confirm'] == 'start' && isset($_SESSION['username'])) {
            $this -> db -> query("SELECT * FROM users_news WHERE user_id = :user_id AND news_id = :news_id");
            $this -> db -> bind(':user_id', $_SESSION['userId']);
            $this -> db -> bind(':news_id', $id);
            $results = $this -> db -> resultSet();
            $numRows = $this -> db -> rowCount();
            if($numRows == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getNewsToEdit($id) {
        $this -> db -> query("SELECT n.id, n.title, n.content,i.src, i.alt
                                FROM news n, news_images i, users u
                                WHERE n.image_id = i.id AND n.id = :id");

        $this -> db -> bind(':id', $id);

        $row = $this -> db -> single();

        return $row;

    }

    public function editNews($data, $image, $path) {

    }
}
