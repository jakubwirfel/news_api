<?php include 'inc/header.php';?>
<?php include 'inc/navbar.php';?>
    <main class="reg-container">
        <h1>Join to <?php echo SITE_TITLE ?></h1>
        <form class="reg-form" method="POST" action="registration.php">
            <div class="form-group">
                <label for="username">Username *</label>
                <input name="username" type="text" id="username" required autocomplete="off" class="even"/>
            </div>
            <div class="form-group">
                <label for="email">Email *</label>
                <input name="email" type="email" id="email" required autocomplete="off"/>
            </div>
            <div class="form-group">
                <label for="password">Password *</label>
                <input name="password_1" type="password" id="password" required autocomplete="off" class="even"/>
            </div>
            <div class="form-group">
                <label for="passwordC">Confirm password *</label>
                <input name="password_2" type="password" id="passwordC" required autocomplete="off"/>
            </div>
            <p>Make sure it's at least 8 characters including a number, special chars and lowercase, uppercase letter.</p>
            <input type="submit" value="Register" name="submit"/>
            <p class="privacy">By creating an account, you agree to the <a href="public/termsofservices.txt" target="_blank">Terms of Service</a>. For more information about Cook From It privacy practices, see the <a href="#" target="_blank">Cook From It Privacy Statement</a>. We'll occasionally send you account-related emails.</p>
        </form>
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
