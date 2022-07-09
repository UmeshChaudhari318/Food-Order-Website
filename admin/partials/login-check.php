
  <?php
    //check weather user is logged or not

    if(!isset($_SESSION['user']))
    {
        //user is not logged in
        $_SESSION['no-login-message'] = "<div Class='error text-center'>Please Login to acces Admin panel.</div>";

        header('location:'.SITEURL.'admin/login.php');
    }
  ?>