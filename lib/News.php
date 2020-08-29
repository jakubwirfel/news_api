<?php

class News {
    protected $db;

    //SUPORTTED FORMATS FOR IMG
    private $_suporttedFormats = ['image/png','image/jpeg','image/jpg'];

    // CONNECT TO DATABASE
    public function __construct() {
        $this -> db = new Database;
    }

    //Add new news
    public function addNews($data, $image) {
        if (in_array($image['type'], $this->_suporttedFormats)) {
            move_uploaded_file($image['tmp_name'],'./public/news_img/'. $image['name']);
            $imagePath = './public/news_img/'. $image['name'];
            $_SESSION['path'] = $imagePath;
            $imageName = $image['name'];

            //Add image to news_images table
            $this -> db -> query("INSERT INTO news_images (name, alt, src) VALUES (:name, :alt, :src)");

            $this -> db -> bind(':name', $imageName);
            $this -> db -> bind(':alt', $imageName);
            $this -> db -> bind(':src', $imagePath);

            if($this -> db -> execute()) {
                // Get added image Id
                $this -> db -> query("SELECT id FROM news_images WHERE src = :src");

                $this -> db -> bind(':src', $imagePath);

                $row = $this -> db -> single();

                $_SESSION['imageId'] =  $row -> id;

                //Add news to news table
                $this -> db -> query("INSERT INTO news (title, content, creation_date, views, image_id) VALUES (:title, :content, :date, :views, :img_id)");

                $this -> db -> bind(':title', $data['title']);
                $this -> db -> bind(':content', $data['content']);
                $this -> db -> bind(':date', date("Y-m-d"));
                $this -> db -> bind(':views', 0);
                $this -> db -> bind(':img_id', $_SESSION['imageId']);

                if($this -> db -> execute()) {
                    //Get added news Id
                    $this -> db -> query("SELECT id FROM news WHERE title = :title AND content = :content");

                    $this -> db -> bind(':title', $data['title']);
                    $this -> db -> bind(':content', $data['content']);

                    $row = $this -> db -> single();

                    $_SESSION['newsId'] =  $row -> id;

                    //Add to users_news table values
                    $this -> db -> query("INSERT INTO users_news (user_id, news_id) VALUES (:user_id, :news_id)");

                    $this -> db -> bind(':user_id', $_SESSION['userId']);
                    $this -> db -> bind(':news_id', $_SESSION['newsId']);

                    if($this -> db -> execute()) {
                        //If news added to all tables
                        unset($_SESSION['imageId']);
                        unset($_SESSION['newsId']);
                        return true;
                    } else {
                        //If news add to table users_news in ERROR delete data from news and news_iamge
                        $this -> db -> query("DELETE FROM news WHERE id = :id");
                        $this -> db -> bind(':id', $_SESSION['newsId']);
                        $this -> db -> execute();
                        $this -> db -> query("DELETE FROM news_images WHERE id = :id");
                        $this -> db -> bind(':id', $_SESSION['imageId']);
                        $this -> db -> execute();
                        return false;
                    }

                } else {
                    //If news add to table news in ERROR delete data from news_iamge
                    $this -> db -> query("DELETE FROM news_images WHERE id = :id");
                    $this -> db -> bind(':id', $_SESSION['imageId']);
                    $this -> db -> execute();
                    return false;
                }

            } else {
                //If news add to table news_iamge in ERROR delete img from directory
                unlink($_SESSION['path']);
                unset($_SESSION['path']);
                return false;
            }
        }
    }

    //Get all news data (to print  news on front page)
    public function displayNewsList() {
        $this -> db -> query("SELECT DISTINCT n.id, n.title, n.content, n.creation_date, n.views, i.alt, i.src, u.name FROM news n
                                LEFT JOIN news_images i ON n.image_id = i.id
                                LEFT JOIN users_news un ON n.id = un.news_id
                                LEFT JOIN users u ON u.id = un.user_id
                                GROUP BY n.id
                                ORDER BY n.id DESC");

        $results = $this -> db -> resultSet();

        return $results;
    }

    //Get all contributors
    public function getContributors() {
        $this -> db -> query("SELECT un.news_id,u.name
                                FROM users_news un
                                LEFT JOIN users u ON u.id = un.user_id");

        $results = $this -> db -> resultSet();

        return $results;
    }

    //Get news data where news Id (to checkout news)
    public function displayNews($id) {
        $this -> db -> query("SELECT n.id, n.title, n.content, n.creation_date, n.views, i.alt, i.src, u.name FROM news n
                                LEFT JOIN news_images i ON n.image_id = i.id
                                LEFT JOIN users_news un ON n.id = un.news_id
                                LEFT JOIN users u ON u.id = un.user_id
                                WHERE n.id = :id");

        $this -> db -> bind(':id', $id);

        $row = $this -> db -> single();

        return $row;
    }

     //Get news data where user name (to display user news)
    public function  displayUserNews($name) {
        $this -> db -> query("SELECT n.id, n.title, n.content, n.creation_date, n.views, i.alt, i.src, u.name FROM news n
                                LEFT JOIN news_images i ON n.image_id = i.id
                                LEFT JOIN users_news un ON n.id = un.news_id
                                LEFT JOIN users u ON u.id = un.user_id
                                WHERE u.name = :name
                                ORDER BY n.id DESC");

        $this -> db -> bind(':name', $name);

        $results = $this -> db -> resultSet();

        return $results;
    }

    //Count views of the news
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

    //Checkout that user can edit news
    public function checkNewsToUser($id) {
        if(isset($_SESSION['confirm']) && $_SESSION['confirm'] == 'start' && isset($_SESSION['userId'])) {
            $this -> db -> query("SELECT * FROM users_news WHERE user_id = :user_id AND news_id = :news_id");
            $this -> db -> bind(':user_id', $_SESSION['userId']);
            $this -> db -> bind(':news_id', $id);
            $results = $this -> db -> resultSet();
            $numRows = $this -> db -> rowCount();
            if($numRows === 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Get news to edit
    public function getNewsToEdit($id) {
        $this -> db -> query("SELECT n.id, n.title, n.content,i.src, i.alt
                                FROM news n, news_images i, users u
                                WHERE n.image_id = i.id AND n.id = :id");

        $this -> db -> bind(':id', $id);

        $row = $this -> db -> single();

        return $row;

    }

    // Update news function
    public function editNews($title, $content, $id) {
        $this -> db -> query("UPDATE news SET title = :title, content = :content, creation_date = :date WHERE id = :id");

        $this -> db -> bind(':title',$title);
        $this -> db -> bind(':content', $content);
        $this -> db -> bind(':date', date("Y-m-d"));
        $this -> db -> bind(':id', $id);

        if($this -> db -> execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Add contributor to news
    public function addContributor($contId, $newsId) {
        //Select contributors to news
        $this -> db -> query("SELECT user_id, news_id FROM users_news WHERE news_id = :id AND user_id LIKE :userId");

        $this -> db -> bind(':id', $newsId);
        $this -> db -> bind(':userId', $contId);

        $results = $this -> db -> resultSet();
        $numRows = $this -> db -> rowCount();
        //Check execute and no duplicate
            if($numRows === 0) {
                $this -> db -> query("INSERT INTO users_news (user_id, news_id) VALUES (:user_id, :news_id)");

                $this -> db -> bind(':user_id', $contId);
                $this -> db -> bind(':news_id', $newsId);

                if($this -> db -> execute()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
    }

    //Get 3 best news of the week
    public function getBestNews() {
        $this -> db -> query("SELECT n.id, n.title, n.views
                                FROM news n
                                WHERE creation_date BETWEEN :date1 AND :date2
                                ORDER BY views DESC LIMIT 3");

        $this -> db -> bind(':date1',date('Y.m.d',strtotime("-7 days")));
        $this -> db -> bind(':date2', date("Y-m-d"));

        $results = $this -> db -> resultSet();

        return $results;
    }

    //Get 3 best users of the week
    public function getBestUsers() {
        $this -> db -> query("SELECT u.name, COUNT(un.id) AS countNews FROM users u
                                LEFT JOIN users_news un ON un.user_id = u.id
                                LEFT JOIN news n ON n.id = un.news_id
                                WHERE n.creation_date BETWEEN :date1 AND :date2
                                GROUP BY un.user_id ORDER BY countNews DESC LIMIT 3");

        $this -> db -> bind(':date1',date('Y.m.d',strtotime("-7 days")));
        $this -> db -> bind(':date2', date("Y-m-d"));

        $results = $this -> db -> resultSet();

        return $results;
    }
}
