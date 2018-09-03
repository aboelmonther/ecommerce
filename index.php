<?php
session_start();
$noNavbar='';
$pageTitle = 'Login';
if (isset($_SESSION['username'])){
    
      	header('location: dashbord.php');
//test for git
          }
 

   //$tpl shortcut Routs
   include'int.php';
  

   // check If User Coming From HTTP Post Request

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  	   $username = $_POST['user'];
  	   $password = $_POST['pass'];
  	   $hashedPass = sha1($password);

  	   // Chek If The User Exist In Database

  	$stmt = $con->prepare("SELECT userID, username, password 
                           FROM users 
                           WHERE username = ?  
                           AND password = ?
                           AND GroupID = 1
                           LIMIT 1
                           ");
  	   $stmt->execute(array($username, $hashedPass));
       $row = $stmt->fetch();
  	   $count = $stmt->rowCount();

  	   //If Count > 0 This Mean The Database Contain Record About This UserName

  	   if ($count > 0) {
  	   
          $_SESSION['username'] = $username;// Register Session Name
          $_SESSION['ID'] = $row['userID']; // Register Session ID
      	header('location: dashbord.php');//Redirect To Dashboard Page
      			exit();		
          }

   }


   ?>
                          <!--Open in the same page-->
      <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="POST">

      	<h4 class="text-center">Admin Login</h4>
      	   <input class="form-control" type="text" name="user" placeholder="username" autocomplete="of"/>
      	   <input class="form-control"type="password" name="pass" placeholder="password" autocomplete="new-password"/>
           <input class="btn btn-primary btn-block" type="submit" value="login"/>
      </form>
   <?php
   include $tpl . 'footer.php' ; ?>