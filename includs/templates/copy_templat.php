<?php

/*Template Page*/
ob_start();

session_start();
$pageTitle = '';

if (isset($_SESSION['username'])){

    include 'int.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') {

        echo 'Welcom';

    } elseif ($do == 'Add'){

    } elseif ($do == 'Insert'){

    } elseif ($do == 'Edit'){

    } elseif ($do == 'Ubdate'){

    } elseif ($do == 'Delete'){

    } elseif ($do == 'Activate'){

    }

    include $tpl . 'footer.php';

} else {

    header ('Location: index.php');
    exit();
}

 ob_end_flush();

?>
