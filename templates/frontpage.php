<?php include 'inc/header.php';?>
<?php include 'inc/navbar.php';?>
    <main class="main-container">
        <section class="news-box">
            <div class="box">
                <h1>News</h1>
                <?php  if (isset($_SESSION['confirm']) && $_SESSION['confirm'] == 'start') : ?>
                    <a href="add.php"><i class="fas fa-plus"></i>Add news</a>
                <?php endif;?>
            </div>
            <?php foreach($newsList as $news):?>
            <article class="news">
                <a href="news.php?news=<?php echo $news -> id?>">
                    <div class="content">
                        <h2><?php echo $news -> title?></h2>
                        <div class="info">
                            <p><?php echo $news -> content?></p>
                        </div>
                        <div class="box">
                            <span><?php echo $news -> name?> / <?php echo $news -> creation_date?></span>
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
            </article>
            <?php endforeach;?>
        </section>
        <div class="line"></div>
        <aside class="info">
            <div class="best-authors">
                <h3>Best authors of the week</h3>
                <a href="profile.php?name=test"><span>1.</span> Test 1</a>
                <a href="profile.php"><span>2.</span> Test 2</a>
                <a href="profile.php"><span>3.</span> Test 3</a>
            </div>
            <div class="best-news">
                <h3>Best news of the week</h3>
                <a href="news.php"><span>1.</span> Test news 1</a>
                <a href="news.php"><span>2.</span> Test news 2</a>
                <a href="news.php"><span>3.</span> Test news 3</a>
            </div>
        </aside>
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
