<nav class="navigation">
    <div class="nav-box" id="navbar">
        <div class="logo">
            <h1><?php echo SITE_TITLE ?></h1>
        </div>
        <div class="items">
            <a  href="index.php" class="item">
                Home
            </a>
            <?php  if (isset($_SESSION['confirm']) && $_SESSION['confirm'] == 'start') : ?>
                <a href="profile.php?name=<?php echo $_SESSION['username'] ?>" class="item">
                    My profile
                </a>
                <a href="<?php echo $_SERVER['PHP_SELF'] ?>?logout='1'" class="item">
                    Logout
                </a>
            <?php else: ?>
                <a href="#login" class="item">
                    Sign In
                </a>
                <a href="registration.php" class="item">
                    Sign Up
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div id="login" class="modal-window">
    <div>
        <a href="#" title="Close" class="modal-close">Close</a>
        <div class="modal-header">
            <h1>Login</h1>
        </div>
            <form class="form-login" accept-charset="UTF-8" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label class="label-login">
                    Username
                </label>
                <div class="field-wrap-login">
                    <input class="input-login" type="text" required autocomplete="off" name="user"/>
                </div>
                <label class="label-login">
                    Password
                </label>
                <div class="field-wrap-login">
                    <input class="input-login" type="password" required autocomplete="off" name="password"/>
                </div>
                <input type="submit" value="Login" class="button-login" name="login"/>
            </form>
    </div>
</div>