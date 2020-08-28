<?php include 'inc/header.php';?>
<?php include 'inc/navbar.php';?>
    <main class="user-container">
        <section class="user-data">
            <h2>User Test news</h2>
            <div class="box">
                <input disabled type="text" placeholder="test@test.wp">
                <a href="#change">Change</a>
            </div>
            <div class="box">
                <input disabled type="password" value="emptyemptyempty">
                <a href="#change">Change</a>
            </div>
        </section>
        <article class="user-news">
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
                <a class="edit" href="edit.php"><i class="fas fa-edit"></i></a>
                <img src="https://via.placeholder.com/300.png/09f/fffC/O https://placeholder.com/" alt="test">
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
