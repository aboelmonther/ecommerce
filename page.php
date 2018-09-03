<?php
/*
  Categories => [ Manage | Edit | Update | Add |Insert | Delete | Stats]
*/
  //condition ? True : False / if -> shortcut
 //$do = isset(#_GET['do']) ? $_GET['do'] : 'Manage';

 $do = '';

 if (isset($_GET['do'])) {

    $do = $_GET['do'];
 }else{

     $do = 'Manage';
 }
   // If The Page IS Main Page
 if ($do == 'Manage')  {

 	echo 'Welcom You Are In Add Manage Category Page';
 	echo '<a href="page.php?do=Add">Add New Category +</a>';
 } 

     elseif ($do == 'Add') {

 	echo 'Welcom You Are In Add Category page';

 	 }

 	 elseif ($do == 'Insert') {
 	 echo 'Welcom You Are In Insert Category page';	

 	 }
    
     else {

 	 	echo ' Error :: No Page With This Page';
 	 }