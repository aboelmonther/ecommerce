<?php
ob_start();// Output Buffering Start
session_start();

if (isset($_SESSION['username'])){
     
     $pageTitle = 'Dashboard';

   include 'int.php';
   /* start Dashboard Page*/

    $latestusers = 5 ; // Number Of Latest Users

    $thelatest = getLatest("*","users","useriD", $latestusers);// Latest User Array

    ?>
    <div class="home-stats">
        <div class="container  text-center">
            <h1>Dashboard</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="stat st-members">
                        Total Members
                        <span><a href="members.php"><?php echo countItems('useriD', 'users')?></a></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-pending">
                        Pending Members
                        <span><a href="members.php?do=Manage&page=Pending"><?php echo checkItem("Regstatus", "users", 0)?></a></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-items">
                        Total Items
                        <span>1500</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-comments">
                        Total Comments
                        <span>3500</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="latest">
          <div class="container ">
              <div class="row">
                  <div class="col-sm-6">

                      <div class="panel panel-defualt">
                          <div class="panel-heading">
                              <i class="fa fa-users"></i> Latest <?php echo $latestusers ?> Register Users
                          </div>
                          <div class="panel-body">
                              <ul class="list-unstyled latest-users">
                                      <?php

                                      foreach ($thelatest as $user) {

                                          echo '<li>';
                                              echo $user['username'];
                                              echo '<a href="members.php?do=Edit&userid= '. $user['useriD'] . '">';
                                              echo '<span class="btn btn-success pull-right">';
                                                   echo '<i class="fa fa-edit"></i> Edit';
                                          if ($user['RegStatus'] == 0){

                                              echo "<a href='members.php?do=Activate&userid= " . $user['useriD'] . " 'class='btn btn-info pull-right activate'> <i class='far fa-closed-captioning'></i> Activate</a>";
                                          }

                                              echo '</span>';
                                              echo'</a>';
                                          echo '</li>';
                                          }
                                      ?>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="panel panel-defualt">
                          <div class="panel-heading">
                              <i class="fa fa-tag"></i>Latest Items
                          </div>
                          <div class="panel-body">
                              Test
                          </div>
                      </div>
                  </div>

              </div>
          </div>
    </div>



  <?php

    /* End Dashbord Page*/

   include $tpl . 'footer.php' ;

          } else {

          	header('location: index.php');

          	exit();

          }

ob_end_flush();

?>