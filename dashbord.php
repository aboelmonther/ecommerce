<?php
	
session_start();

if (isset($_SESSION['username'])){
     
     $pageTitle = 'Dashboard';

   include 'int.php';

print_r($_SESSION);
   include $tpl . 'footer.php' ;


          } else {

          	header('location: index.php');

          	exit();

          }



