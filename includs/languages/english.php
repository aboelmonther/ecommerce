<?php
 
 function lang($phrase){
 	static $lang =array(

//  Navbar Links
 		'CATEGORIES'     =>  'categories',
 		'ITEMS'          =>  'items',
 		'MEMBERS'        =>  'members',
 		'STATISTICS'     =>  'statistics',
 		'LOGS'           =>  'logs'

 	);

 	return $lang[$phrase];
 }