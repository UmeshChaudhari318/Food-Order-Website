<?php include('partials/menu.php'); ?>

<div Class="main-content">
    <div Class="wrapper">
        <h1>Add Admin</h1>
        <br><br>


        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST">
        <table Class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td>

                    <input type="text" name="full_name" placeholder="Enter Your Name">
                
                </td>
            </tr>
            <tr>
                <td>User Name:</td>
                <td>
                    
                    <input type="text" name="username" placeholder="Enter Your User Name">
                
                </td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    
                    <input type="password" name="password" placeholder="Enter Your Password">
                
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" Class="btn-secondary">

                </td>
            </tr>


        </table>
        </form>

    </div>
</div>



<?php include('partials/footer.php'); ?>

<?php
    //process the value from form and save it into database
    //check weather the submit button is clicked or not

    if(isset($_POST['submit']))
    {
       // echo"Button Clicked";
        //1.get the data from form
         $full_name = $_POST['full_name'];
         $username = $_POST['username'];
         $password = md5($_POST['password']);//password encryption with md5

         //2.sql query to save the data into database

         $sql = "INSERT INTO tbl_admin SET

         full_name='$full_name',
         username='$username',
         password='$password'
         ";
         
         //3.executing and saving data into database

         $res = mysqli_query($conn, $sql) or die(mysqli_error());

         //4. check weather the data is inserted or not
        if($res==TRUE)
        {
            //data inserted
           // echo"data inserted";
           //create a session variable
           $_SESSION['add']= "Admin Added succesfully";
           //redirect page
           header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //failed to inserted data
          //  echo"failed to insert data";
          //create a session variable
          $_SESSION['add']= "Failed to Add Admin";
          //redirect page
          header("location:".SITEURL.'admin/add-admin.php');
        }


    }

    
?>