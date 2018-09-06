<?php
session_start();

if (isset($_SESSION['username'])){
     
     $pageTitle = 'Dashboard';

   include 'int.php';

   include $tpl . 'footer.php' ;
    echo 'Welcom to index';


          } else {

          	header('location: index.php');

          	exit();

          }



