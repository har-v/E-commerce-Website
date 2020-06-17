<?=template_header('Password Recovery')?>
<style>
    form {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;

    }
    form input[type="text"] {
        width: 331px;
        height: 50px;
        border: 1px solid #dee0e4;
        margin-top: 180px;
        margin-left: -30px;
        padding: 0 40px;
        border-radius: 100px;
        font-family: 'Heebo', sans-serif;
        font-weight: bolder;
        outline: none;
    }
    form input[type="submit"] {
        width: 12%;
        padding: 15px;
        margin-top:250px;
        margin-left: -10px;
        background-color: #d4c0c8;
        border: 0;
        cursor: pointer;
        font-weight: bold;
        color: #ffffff;
        transition: background-color 0.2s;
        border-radius: 100px;
        margin-bottom: 10px;
        position: absolute;
        outline: none;
    }

    form input[type="submit"]:hover {
        background-color: #95878d;
        transition: background-color 0.2s;
    }

    .table1 {
        margin-top: 30px;
        margin-left: 620px;
        text-align: justify;
    }


    @media (max-width: 800px){
        form input[type="submit"] {
            width: 40%;
        }
        .table1 {
            margin-left: 190px;
        }

        .link-login{
            display: none;
        }
    }

    @media (min-width: 1520px) {
        .table1 {
            margin-left: 880px;
        }

        .link-login{
            margin-left: 260px;
        }
    }

</style>
<form action="" method="POST">
    <input type="text" name="username" placeholder="ENTER USERNAME">
    <input type="submit" name="search" value="GET PASSWORD">
</form>

<table class="table1">
    <tr>
        <th style="font-size: 20px;">Password:</th>
        <?php
        $connection = new mysqli("localhost", "root", "", "phplogin");

        if(isset($_POST['search']))
        {
            $username = $_POST['username'];

            $query = "SELECT * FROM accounts WHERE username='$username'";
            $query_run = mysqli_query($connection,$query);

            while($row = mysqli_fetch_array($query_run))
            {
                ?>
                <tr>
        <td style="font-size: 20px;">
            <?php echo $row['password'];?>
        </td>
        <?php
            }
        }
        ?>
        <p style="font-family: 'Fjalla One', sans-serif; font-size: 12px; margin-top: 70px; margin-left: 630px;"><a href="index.php?page=login" style="color:#bea100" class="link-login">BACK TO LOGIN</a></p>

    </tr>
</table>
<?=template_footer()?>