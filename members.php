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

   if ($do == 'Manage') { // Manage Members Page

        $query = '';

        if (isset($_GET['page']) && $_GET['page'] == 'Pending'){

            $query = 'AND RegStatus = 0';
       }
    // Select All Users Except Admin
       $stmt = $con->prepare("SELECT * FROM users WHERE GroupiD != 1 $query ");

       // Execute The Statement

       $stmt->execute();

       // Assign To Variable

       $rows = $stmt->fetchAll();

       ?>

       <h1 class="text-center">Manage Members</h1>
       <div class="container">
           <div class="table-responsive">
               <table class="main-table text-center table table-bordered">
                   <tr>
                       <td>#ID</td>
                       <td>Username</td>
                       <td>Email</td>
                       <td>Full Name</td>
                       <td>Registerd Date</td>
                       <td>Control</td>
                   </tr>
          <?php
               foreach($rows as $row){
                   echo "<tr>";
                        echo "<td>" . $row['useriD'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['Email'] . "</td>";
                        echo "<td>" . $row['FullName'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>
                                                 <!-- Edit -->
                              <a href='members.php?do=Edit&userid= " . $row['useriD'] . " 'class='btn btn-success'> <i class='fa fa-edit'></i> Edit</a>
                              <a href='members.php?do=Delete&userid= " . $row['useriD'] . " 'class='btn btn-danger confirm'> <i class='far fa-closed-captioning'></i> Delete </a>";

                                if ($row['RegStatus'] == 0){

                                   echo "<a href='members.php?do=Activate&userid= " . $row['useriD'] . " 'class='btn btn-info activate'> <i class='far fa-closed-captioning'></i> Activate</a>";
                                }
                              echo"</td>";

                echo "</tr>";

               }

          ?>


               </table>
           </div>
           <a href= "members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> New Member</a>

       </div>



 <?php  }elseif ($do == 'Add') {// add Members page ?>


       <h1 class="text-center">Add New Member</h1>

       <div class="container">
           <form class="form-horizontal" action="?do=Insert" method="POST">
               <!-- Start username field-->

               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Username</label>
                   <div class="col-sm-10 col-md-6">
                       <input type="text" name="username" class="form-control" autocomplete="off" required="required"
                              placeholder=" Username To Login Into Shop"/>
                   </div>
               </div>

               <!-- End username field-->

               <!-- Start password field-->

               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Password</label>
                   <div class="col-sm-10 col-md-6">

                       <!--google dont remamber bassword-->
                       <input type="password" name="password" class="password form-control" autocomplete="new-password" required="required"
                             placeholder=" Password Must be Hard & complex"/>
                       <i class="show-pass fa fa-eye fa-1x"></i>

                   </div>
               </div>

               <!-- End password field-->

               <!-- Start email field-->

               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Email</label>
                   <div class="col-sm-10 col-md-6">
                       <input type="email" name="email" class="form-control" required="required"
                              placeholder="Email Must Be Valid"/>
                   </div>
               </div>

               <!-- End email field-->

               <!-- Start fullname field-->

               <div class="form-group form-group-lg">
                   <label class="col-sm-2 control-label">Full Name</label>
                   <div class="col-sm-10 col-md-6">
                       <input type="text" name="full" class="form-control" required="required"
                              placeholder="Full Name Appear In Your Profile Page"/>
                   </div>
               </div>

               <!-- End fullname field-->

               <!-- Start submit field-->

               <div class="form-group form-group-lg">
                   <div class="col-sm-offset-2 col-sm-10">
                       <input type="submit" value="Add Member" class="btn btn-primary btn-lg"/>
                   </div>
               </div>

               <!-- End submit field-->

           </form>
       </div>


       <?php

   } elseif ($do == 'Insert'){     // Insert Member Page



       if ($_SERVER['REQUEST_METHOD']=='POST'){

           echo "<h1 class='text-center'>Update Member</h1>";

           echo "<div class = 'container'>";


           // Get variables Form The Form

           $user      =   $_POST['username'];
           $pass      =  $_POST['password'];
           $email     =   $_POST['email'];
           $name      =   $_POST['full'];


          $hashPass = sha1($_POST['password']);




           // validate The Form
           $formErrors = array();

           if (strlen($user) < 4 ) {

               $formErrors[] = 'Username Cant Be Less Than <strong> 4 Characters</strong>';

           }

           $formErrors = array();

           if (strlen($user) > 20 ){

               $formErrors[] = 'Username Cant Be More Than <strong>20 Characters</strong>';

           }
           if (empty($user)){

               $formErrors[] = 'Username Cant be<strong>Empty</strong>';
           }

           if (empty($pass)){

               $formErrors[] = 'Password Cant be<strong>Empty</strong>';
           }
           if (empty($name)){

               $formErrors[] = ' Fullname Cant be <strong>Empty</strong>';
           }
           if (empty($email)){

               $formErrors[] = '  Email Cant be <strong>Empty</strong>';
           }

           // Loop Into Errors Arry And Echo It

                                foreach ($formErrors as $error){

               echo  '<div class = "alert alert-danger">' . $error . '</div>';
           }

           // Check If Ther no Error Proceed The Update Operation

           if (empty($formErrors)) {

               // Check If User Exist in Database

               $check = checkItem("username", "users", $user);

               if ($check == 1){

                   $theMsg = '<div class="alert alert-danger">Sorry This User Is Exist</div>';

                   redirectHome($theMsg, 'back');

               } else {
                   // Insert Userinfo Database

                   $stmt = $con->prepare("INSERT INTO users(username, password, Email, FullName, RegStatus, Date)  

                                             VALUES(:zuser, :zpass, :zmail, :zname, 1, now()) ");
                   $stmt->execute(array(

                       'zuser' => $user,
                       'zpass' => $hashPass,
                       'zmail' => $email,
                       'zname' => $name

                   ));

                   // Echo Success Message

                   $theMsg = "<div class = 'alert alert-success'>" . $stmt->rowCount() . 'Record Inserted</div>';

                   redirectHome($theMsg, 'back', 4);

               }
           }

       }else{

           echo "<div class='container'>";

           // Home Redirect function this function accept parameters

           $theMsg =  '<div class = "alert alert-danger"> .  Sorry You Cant Browse This Page Directly</div>';

           redirectHome($theMsg);

           echo "</div>";
       }

       echo "</div>";




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

        if (  $count > 0 ){    ?>

             <h1 class="text-center">Edit Member</h1>


             <div class="container">
                <form class="form-horizontal" action="?do=Update" method="POST">
                  <input type="hidden" name="userid" value="<?php echo $userid ?>"/>

                  <!-- Start username field-- >

                  <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10 col-md-6">
                      <input type="text" name="username" class="form-control" value="<?php echo $row['username']?>" autocomplete="off" required="required" />
                    </div>
                  </div>

                  <!-- End username field-->

                    <!-- Start password field-->

                  <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10 col-md-6">
                      <input type="hidden" name="oldpassword" value="<?php echo $row['password'] ?>"   />

                                                                       <!--google dont remamber bassword-->
                        <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave Blank If You Dont Want To Change" />

                    </div>
                  </div>

                  <!-- End password field-->

                    <!-- Start email field-->

                  <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10 col-md-6">
                      <input type="email" name="email" value="<?php echo $row['Email'] ?>" class="form-control" required="required" />
                    </div>
                  </div>

                  <!-- End email field-->

                    <!-- Start fullname field-->

                  <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-10 col-md-6">
                      <input type="text" name="full"  value="<?php echo $row['FullName'] ?>" class="form-control"  required="required"/>
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

            echo"<div class='container'>";

            $theMsg =  '<div class="alert alert-danger"> Theres  No Such ID</div>';

            redirectHome($theMsg);

            echo "</div>";
           }
     } elseif ($do == 'Update') { //  Update Page

                 echo "<h1 class='text-center'>Update Member</h1>";

                 echo "<div class = 'container'>";

                 if ($_SERVER['REQUEST_METHOD']=='POST'){


                  // Get variables Form The Form

                  $id      =   $_POST['userid'];
                  $user    =   $_POST['username'];
                  $email   =   $_POST['email'];
                  $name    =   $_POST['full'];


                     //password Trick
                     /**  $pass = '';
                     if(empty($_POST['newpassword'])){
                     $pass = $_POST['oldpassword'];
                     }else{
                     $pass = sha1( $_POST['newpassword']);
                     } **/

                  //Condition ? True : False ; short cut code         True                    false
                     $pass = empty($_POST['newpassword']) ?  $_POST['oldpassword'] :  sha1( $_POST['newpassword']) ;

                     // validate The Form
                     $formErrors = array();

                     if (strlen($user) < 4 ) {

                         $formErrors[] = 'Username Cant Be Less Than <strong> 4 Characters</strong>';

                     }

                     $formErrors = array();

                     if (strlen($user) > 20 ){

                         $formErrors[] = 'Username Cant Be More Than <strong>20 Characters</strong>';

                     }
                     if (empty($user)){

                         $formErrors[] = 'Username Cant be<strong>Empty</strong>';
                     }
                     if (empty($name)){

                         $formErrors[] = 'Name Cant be <strong>Empty</strong>';
                     }
                     if (empty($email)){

                         $formErrors[] = ' Cant be <strong>Empty</strong>';
                     }

                     // Loop Into Errors Arry And Echo It

                     {}                     foreach ($formErrors as $error){

                         echo  '<div class = "alert alert-danger">' . $error . '</div>';
                     }

                     // Check If Thers no Error Proceed The Update Operation
                         if (empty($formErrors)){



                             // Update The Database With This Info

                             $stmt = $con->prepare("UPDATE users SET Username = ? , Email = ? , FullName = ? , password = ? WHERE UserID = ?");
                             $stmt->execute(array($user, $email, $name, $pass, $id));

                             // Echo Success Message

                             $theMsg =  "<div class = 'alert alert-success'>" .  $stmt->rowCount() . 'Record Updated</div>';

                             redirectHome($theMsg, 'back', 4);
                         }

                      }else{

                             $theMsg =  '<div class = "alert alert-danger"> Sorry You Cant Browse This Page Directly</div>';

                             redirectHome($theMsg);

                 }

                 echo "</div>";

     } elseif ($do == 'Delete'){ // Delete Member Page

      echo "<h1 class='text-center'>Delete Members</h1>";
      echo" <div class='container'>";

        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

        // Check If The User Exist In Database

        // select all data depend on this id

       // $stmt = $con->prepare("SELECT  * FROM users WHERE UserID = ? LIMIT 1 ");

      $check = checkItem ('userid', 'users', $userid);



        // if ther's such id show the form

        if (  $check > 0 ) {

            $stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");

            $stmt->bindParam(":zuser",$userid);

            $stmt->execute();


            $theMsg = "<div class = 'alert alert-success'>" .  $stmt->rowCount() . 'Record Delete</div>';

            redirectHome($theMsg);

        }  else{

            $theMsg =  '<div class = "alert alert-danger">This ID is Not Exist</div>';

            redirectHome($theMsg);
}

      echo '</div>';
   } elseif ($do == 'Activate') {

       echo "<h1 class='text-center'>Activate Member</h1>";
       echo" <div class='container'>";

       $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

       // Check If The User Exist In Database

       // select all data depend on this id

       // $stmt = $con->prepare("SELECT  * FROM users WHERE UserID = ? LIMIT 1 ");

       $check = checkItem ('userid', 'users', $userid);



       // if ther's such id show the form

       if (  $check > 0 ) {

           $stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE useriD = ?");


           $stmt->execute(array($userid));


           $theMsg = "<div class = 'alert alert-success'>" .  $stmt->rowCount() . 'Record Activate</div>';

           redirectHome($theMsg);

       }  else{

           $theMsg =  '<div class = "alert alert-danger">This ID is Not Exist</div>';

           redirectHome($theMsg);
       }

       echo '</div>';   }


   include $tpl . 'footer.php' ;


          } else {

          	header('location: index.php');

          	exit();

          }



