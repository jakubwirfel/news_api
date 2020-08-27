<nav class="navigation">
    <div class="nav-box" id="navbar">
        <div class="logo">
            <h1><?php echo SITE_TITLE ?></h1>
        </div>
        <div class="items">
            <a class="item">
                Home
            </a>
            <a href="#login" class="item">
                Sign In
            </a>
            <a class="item">
                Sign Up
            </a>
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