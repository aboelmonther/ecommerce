<?php
 
/*
** Title Function That Echo The Page In Case The Page
** Has The Variable $pageTitle And echo Defult Title For Other Pages
*/

function getTitle(){

	global $pageTitle;
	if (isset($pageTitle)){

		echo $pageTitle;

	}else{
		echo 'Default';
	}
}