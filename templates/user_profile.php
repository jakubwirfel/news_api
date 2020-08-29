<?php include 'inc/header.php';?>
<?php include 'inc/navbar.php';?>
    <main class="user-container">
        <section class="user-data">
            <h2>User <?php echo $_GET['name'] ?> news</h2>
        </section>
        <?php foreach($newsList as $news):?>
        <article class="article">
            <a href="news.php?news=<?php echo $news -> id?>" class="user-news">
                <div class="content">
                    <h2><?php echo $news -> title?></h2>
                    <p><?php echo $news -> content?></p>
                    <div class="box">
                        <span><?php foreach($contributorsList as $contributor) {
                                if($contributor -> news_id === $news -> id) {
                                    echo $contributor -> name . ", ";
                                }
                            }
                            ?> / <?php echo $news -> creation_date?></span>
                        <div class="views">
                            <i class="fas fa-eye"></i>
                            <span><?php echo $news -> views?></span>
                        </div>
                    </div>
                </div>
                <div class="img-box">
                    <img src="<?php echo $news -> src?>" alt="<?php echo $news -> alt?>">
                </div>
            </a>
            <?php  if (isset($_SESSION['confirm']) && $_SESSION['confirm'] == 'start' && $_SESSION['username']== $_GET['name']) : ?>
                <button class="edit" onclick="window.location.href='edit.php?id=<?php echo $news -> id?>'"><i class="fas fa-edit"></i></button>
            <?php endif;?>
        </article>
        <?php endforeach;?>
    </main>
<script>
    window.onscroll = () => {
        const nav = document.querySelector('#navbar');
        if (this.scrollY <= 1) {
            nav.classList.add("navigation");
            nav.classList.remove("scroll");
        }
        else {
            nav.classList.add("scroll", "navigation");
        }
    };
</script>
<?php include 'inc/footer.php';?>
