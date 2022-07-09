<?php include('../config/constants.php');?>

<html>
    <head>
        <title>Login-Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">

    </head>
    <body>
        
        <div Class="login">

            <h1 Class="text-center">Login</h1>
            <br><br>
            <?php

                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                    
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                    
                }

            ?>
            <br><br>
            <!-- login form starts -->

            <form action="" method="POST" Class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password:<br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>
                <input type="submit" name="submit" value="Login" Class="btn-primary">
                <br><br>
            </form>

            <!-- login form ends -->

            <p  Class="text-center">Created By - <a href="wwww.programmermagic.in">Umesh Chaudhari</a></p>

        </div>
    </body>
</html>

<?php

    //check weather submit button is clicked or not

  if(isset($_POST['submit']))
  {
      //1.get the data from useer

     // $username=$_POST['username'];
       $username=mysqli_real_escape_string($conn, $_POST['username']);
       $raw_password=md5($_POST['password']);
       $password=mysqli_real_escape_string($conn, $raw_password);

       //2.sql to check weather the user exist or not

       $sql= "SELECT * FROM tbl_admin WHERE username= '$username' AND password='$password'";

       //3.execute the query

       $res=mysqli_query($conn, $sql);

       //4.check user exits or not
       $count= mysqli_num_rows($res);

       if($count==1)
       {
            $_SESSION['login'] ="<div Class='success'>Login Succesfull.</div>";
            $_SESSION['user'] = $username;
            header('location:'.SITEURL.'admin/');
       }
       else
       {
             $_SESSION['login'] ="<div Class='error text-center'>Username or password did not Match.</div>";
              header('location:'.SITEURL.'admin/login.php');
       }
  }

?>