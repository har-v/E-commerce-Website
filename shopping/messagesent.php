<style>
    body {
        overflow-x: hidden;
    }
    h1 {
        font-family: 'Fjalla One', sans-serif;
        font-size: 50px;
        position:relative;
        padding:0 50px 10px 0;
        text-align: left;
        font-weight: bold;
        top:100px;
        color: black;
        left: 37%;
    }

    p {
        font-family: 'Heebo', sans-serif;
        font-weight: bolder;
        font-size: 25px;
        margin-top: 180px;
        margin-left: 15%;
    }

    .text {
        font-family: 'Heebo', sans-serif;
        font-weight: bolder;
        font-size: 25px;
        margin-top: 10px;
        margin-left: 39% !important;
    }



    @media (max-width: 575.98px){
        h1 {
            left: 20%;
        }

        p {
            margin-left: 1%;
        }

        .text {
            margin-left: 10%;
        }
    }
</style>
<?=template_header('Message Sent')?>
<link rel="stylesheet" href="../stylesheets/placeorder.css">
<div class="placeorder content-wrapper">
    <h1>MESSAGE SENT</h1>
    <p>Your message has been sent at <?php
        echo date("h:i A");?> on <?php
        echo(date("F d, Y"));
        ?>.</p>
    <br><br><br>
    <p class="text"><a href="index.php?page=homepage">Return to home page</a></p>
</div>

<?=template_footer()?>

