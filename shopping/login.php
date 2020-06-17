<?=template_header('Login')?>
<link rel="stylesheet" href="../stylesheets/login.css">
    <div class="login">
        <h1 style="font-family: 'Fjalla One', sans-serif;">LOGIN</h1>
        <form action="index.php?page=authenticate" method="post">
            <label for="username">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <input type="submit" value="Login">
        </form>

        <p style="font-family: 'Fjalla One', sans-serif; font-size: 12px; margin-top: 80px; margin-left:190px;"><a href="index.php?page=display" style="color:#bea100">FORGOT PASSWORD?</a></p>
        <p style="font-family: 'Fjalla One', sans-serif; font-size: 12px; margin-top: 20px; margin-left: 190px;"><a href="index.php?page=registerpage" style="color:#bea100">DON'T HAVE AN ACOUNT?</a></p>
    </div>
<?=template_footer()?>