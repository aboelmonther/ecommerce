<?php

/*
===================================
== Manage Member PAge
==You Can Add | Edit |nDelete Members From Here
===================================
*/	
session_start();
$pageTitle = 'members';

if (isset($_SESSION['username'])){
     
   include 'int.php';

   $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

   // Start Manage Page

   if ($do == 'Manage'){

   	// Manage Page

   }elseif ($do == 'Edit') {// Edit Page

      //Data protection
      // if (isset($_GET['userid']) && is_numeric($_GET['userid'])) {
      // echo intval($_GET['userid']);  }else{ echo 0;}


       //short cut code Data protection
      // check if get request userid is numeric & get the integer value of it
                                                                       //true                false
      $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

       // Chek If The User Exist In Database
      // select all data depend on this id 

    $stmt = $con->prepare("SELECT  * FROM users WHERE UserID = ? LIMIT 1 ");

       // execute Query

       $stmt->execute(array($userid));

       // fetch the data

       $row = $stmt->fetch();
       //  the row count
       $count = $stmt->rowCount();

       // if ther's such id show the form

        if (  $stmt->rowCount() > 0 ){    ?>

             <h1 class="text-center">Edit Member</h1>

             <div class="container">
                <form class="form-horizontal" action="?do=Update" method="POST">
                  <input type="hidden" name="userid" value="<?php echo $userid ?>">

                  <!-- Start username field-->

                  <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10 col-md-6"> 
                      <input type="text" name="username" class="form-control" value="<?php echo $row['username']?>" autocomplete="off" />
                    </div>
                  </div>

                  <!-- End username field-->

                    <!-- Start password field-->

                  <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10 col-md-6">
                                                          <!--google dont remamber bassword-->
                      <input type="password" name="password" class="form-control" autocomplete="new-password" />
                    </div>
                  </div>

                  <!-- End password field-->
                  
                    <!-- Start email field-->

                  <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10 col-md-6">
                      <input type="email" name="email" value="<?php echo $row['Email'] ?>" class="form-control" />
                    </div>
                  </div>

                  <!-- End email field-->
                  
                    <!-- Start fullname field-->

                  <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-10 col-md-6">
                      <input type="text" name="full"  value="<?php echo $row['FullName'] ?>" class="form-control" />
                    </div>
                  </div>

                  <!-- End fullname field-->
                  
                    <!-- Start submit field-->

                  <div class="form-group form-group-lg">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" value="Save" class="btn btn-primary btn-lg" />
                    </div>
                  </div>

                  <!-- End submit field-->

                </form>
            </div>


    <?php  
         
         // else show message

           } else {

            echo ' Theres  No ID';
           }
     } elseif ($do == 'Update') { //  Update Page

                 echo  "<h1 class='text-center'> Update Member </h1>";

                 if ($_SERVER['REQUEST_METHOD']=='POST'){
                  // Get varibles Form The Form 

                  $id      =   $_POST['userid'];
                  $user    =   $_POST['username'];
                  $email   =   $_POST['email'];
                  $name    =   $_POST['full'];

                  echo $id . $user . $email . $name;


                 }else{

                   echo 'Sorry You Cant Browse This Page Directly';
                 }

       
     }


   include $tpl . 'footer.php' ;


          } else {

          	header('location: index.php');

          	exit();

          }



