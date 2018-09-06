<?php
 
/*
** Title Function v1.0
** That Echo The Page In Case The Page
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

/**
 * Home Redirect function v1.0
 * this function accept parameters
 * $errorMsg = echo the error message
 * $seconds = seconds before redirecting
 **/

function redirectHome($errorMsg, $seconds = 3){
    echo "<div class= 'alert alert-danger'>$errorMsg</div>";

    echo "<div class='alert alert-info'>You Will Be Redirected To Homepage After $seconds seconds.</div>";

    header("refresh:$seconds;url=index.php");

    exit();
}

/*
 * Check Items Function v1.0
 * function to Check Items In Database [ Function Accept Parameters ]
 * $select = The item To Selcet [Example: user, item, categories ]
 * $Form = the Table To Select from [ Example: users, items, categories ]
 * $value = he Value Of Select [ Example:     monther, Box , Electronics ]
 * */
function checkItem ($select, $from, $value){

    global $con;
    $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");

    $statement->execute(array($value));

    $count = $statement->rowCount();

    return $count;

}