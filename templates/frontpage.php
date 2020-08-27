<?php include 'inc/header.php';?>
<?php include 'inc/navbar.php';?>
    <main class="main-container">
        <section class="news-box">
            <h1>News</h1>
            <article class="news">
                <a href="news.php">
                    <div class="content">
                        <h2>Testowy news 1</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident fugiat reprehenderit asperiores iste ipsa perspiciatis, ea aspernatur alias corrupti vel inventore nihil neque sit laudantium quae, tempora voluptates rem culpa!</p>
                        <div class="box">
                            <span>Jakub Wirfel / 27.08.2020</span>
                            <div class="views">
                                <i class="fas fa-eye"></i>
                                <span>300</span>
                            </div>
                        </div>
                    </div>
                    <div class="img-box">
                        <img src="https://via.placeholder.com/300.png/09f/fffC/O https://placeholder.com/" alt="test">
                    </div>
                </a>
            </article>
        </section>
        <div class="line"></div>
        <aside class="info">
            <div class="best-authors">
                <h3>Best authors of the week</h3>
                <a href="profile.php"><span>1.</span> Test 1</a>
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
