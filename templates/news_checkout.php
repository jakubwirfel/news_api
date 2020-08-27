<?php include 'inc/header.php';?>
<?php include 'inc/navbar.php';?>
    <main class="news-container">
        <article class="news">
            <div class="content">
                <h1>Test news 1</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ipsam consequuntur excepturi aliquam qui architecto quibusdam iste itaque accusamus dolor doloremque placeat a, quae accusantium, minus, assumenda temporibus nesciunt Lorem, ipsum dolor sit amet consectetur adipisicing elit. Provident neque a porro eveniet eaque rerum voluptatem, sunt delectus explicabo modi enim culpa magni ea, pariatur molestiae sed in, aliquam  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorem possimus est, error expedita id quibusdam molestiae nostrum excepturi nam quisquam sint a totam voluptatibus, dolorum deleniti atque corrupti eaque et!</p>
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
