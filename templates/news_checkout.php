<?php include 'inc/header.php';?>
<?php include 'inc/navbar.php';?>
    <main class="reg-container">

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
