<?php include 'inc/header.php';?>
<?php include 'inc/navbar.php';?>
    <main class="news-container">
        <article class="news">
            <div class="content">
                <h1><?php echo $news -> title?></h1>
                <p><?php echo $news -> content?></p>
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
        </article>
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
