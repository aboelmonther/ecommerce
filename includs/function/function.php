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
 * Home Redirect function v2.0
 * this function accept parameters
 * $theMsg = echo The message [ Error | Success | Warning]
 * $url  = The Link You Want To Redirecting To
 * $seconds = seconds before redirecting
 **/

function redirectHome($theMsg, $url = null, $seconds = 3){

    if ( $url === null){

        $url = 'index.php';

        $link = 'Homepage';

    }else{

        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){

            $url = $_SERVER['HTTP_REFERER'];
            $link = 'Previous Page';

        }else{
            $url = 'index.php';
            $link = 'Homepage';

        }
    }

    echo $theMsg;

    echo "<div class='alert alert-info'>You Will Be Redirected To $link After $seconds seconds.</div>";

    header("refresh:$seconds;url=$url");

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
/*
 **Count Number of Items function v1.0
 **Function TO Count Number Of Items Rows
 **$item = The Item To Count
 **$table = The Table To Choose From
 **
 **/
function countItems($item, $table){

    global $con;

    $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");

    $stmt2->execute();

    return $stmt2->fetchColumn();
}