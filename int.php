<?php

include 'connect.php';
  //Routs
 //shotrcut Routs
  $tpl = 'includs/templates/';// Template Directory
  $lang = 'includs/languages/';// Languages Directory
  $func = 'includs/function/'; // function Directory 

 // Include The Important Files
   include $func .'function.php';
   include $lang . 'english.php';
   include $tpl . 'header.php' ;

   // Include Navbar On All Pages Expect The One With $noNavbar Vairable

   if (!isset($noNavbar)){include $tpl . 'navbar.php' ;}
