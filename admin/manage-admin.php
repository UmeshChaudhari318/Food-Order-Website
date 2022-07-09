<?php include('partials/menu.php'); ?> 

        <!--Main Section Starts-->
        <div Class="main-content" >
            <div Class="wrapper">
               <h1>Manage-admin</h1>

               <br/> <br/>

               <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];  //displaying session message 
                        unset($_SESSION['add']);  //removing session message
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }
                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }


               ?>
               <br> <br>
               <!--button to add admin-->
               <a href="add-admin.php" Class="btn-primary">Add Admin</a>

               <br /> <br/> <br/>

               <table Class="tbl-full">
                   <tr>
                       <th>S.N</th>
                       <th>Full Name</th>
                       <th>UserName</th>
                       <th>Action</th>
                   </tr>

                   <?php
                        $sql = "SELECT * FROM tbl_admin";

                        $res = mysqli_query($conn, $sql);

                        if($res==TRUE)
                        {
                            $count = mysqli_num_rows($res);

                            $sn=1;

                            if($count>0)
                            {
                                //we have data in database
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                
                                ?>
                                       <tr>
                                             <td><?php echo $sn++; ?></td>
                                            <td><?php echo $full_name ?></td>
                                            <td><?php echo $username  ?></td>
                                            <td>
                                                 <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" Class="btn-primary">Change Password</a>
                                                 <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" Class="btn-secondary">Update Admin</a>
                                                 <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" Class="btn-danger">Delete Admin</a>
                                             </td>
                                         </tr> 


                                <?php
                                }
                            }
                            else
                            {
                                //we do not have data in database
                            }
                        }
                   ?>




                   
               </table>
              
               <div Class="clearfix"></div>
               </div>
            </div> 
           
        </div>
        <!--Main Section Ends--> 

<?php include('partials/footer.php'); ?>