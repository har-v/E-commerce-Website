<?=template_header('Contact Us')?>
<link rel="stylesheet" href="../stylesheets/contactUs.css">
<div class="register">
    <h1 style="font-family: 'Fjalla One', sans-serif;">CONTACT US</h1>
        <form action='index.php?page=messagesent' method='POST'>
        <label for="email">
            <i class="fas fa-user"></i>
        </label>
        <input type="email" name="email" placeholder="Email" id="email" required>

        <label for="subject">
            <i class="fas fa-envelope"></i>
        </label>
        <input type="text" name="subject" placeholder="Subject" id="subject" required>

        <label for="text">
            <i class="fas fa-pen"></i>
        </label>
        <input type="text" name="text" placeholder="Write something.." id="text" required>

        <input type="submit" value="send">
    </form>
</div>

<?=template_footer()?>
