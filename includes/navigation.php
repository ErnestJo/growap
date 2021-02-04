<?php
require_once 'funcs/function.php';
require_once 'includes/config.php';

$sql = $db -> query("SELECT category FROM product  GROUP BY category ORDER BY pid DESC");

?>

<style>
    

#compname{
    animation-name: compname;
    animation-duration: 7s;
    animation-iteration-count: infinite;
    color: #ff4e4e;
    font-size: 30px;
    text-align: center;
    letter-spacing: 2px;
    padding: 15px 10px 0px 30px;
    cursor: pointer;
    transition: linear color 0.4s;

 }

@keyframes compname{

    from{
        color:white;
    }

    to {

        color:#ff4e4e;
    }

}

  #compname i{
    font-size: 30px;
    color: #ff4e4e;
    font-style: normal;

 }
</style>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand" href="#" id="compname">
      SOKONI
      </a>
        <a class="navbar-brand">
            <p>| PLATFORM</p>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
            <li>
                <form class="form-inline" method="post" action="searchpage.php" id="search">
                    <div class="form-group form-group-sm">
                        <input type="text" name="searchShit" id="search" class="form-control" placeholder="Search...."/>
                    </div>
                    <button name="searchsubmit" type="submit" class="btn btn-default">search</button>
                </form>

            </li>
            <li><a href="index.php">HOME</a></li>
            <li id="categories" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown"> CATEGORIES<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php while ($category = mysqli_fetch_assoc ($sql)) :?>
                    <li><a href="viewmore.php?category=<?=ucwords($category['category']);?>"><?=$category['category'];?></a></li>
                                <?php endwhile ; ?>

                </ul>
            </li> 

            
                
            <?php if(is_loggedin_customer()){ ?>

                <?php

                    $sql1 = $db -> query("SELECT COUNT(id) AS count FROM cart WHERE uid = '$user_id' AND orderid = 0 ");

                    $carts = mysqli_fetch_assoc ($sql1);
                   

                ?>
                    <li id="cart" ><a href="cart.php"><i class="fa fa-shopping-cart"></i>

                            <?php 

                        if ($carts['count'] <> 0)  {
                            

                            echo '<span class="badge">'.$carts['count'].'</span></a></li>';
                        }
                        else{

                            echo '</a></li> ';
                        }

                    ?>

                       

                    <?php

                    $sql2 = $db -> query("SELECT COUNT(orderid) AS count FROM cart WHERE uid = '$user_id' AND orderid <> 0 AND confirm = 1 AND userread = 0 ");

                    $sql3 = $db -> query("SELECT COUNT(id) AS count FROM requests WHERE userid = '$user_id' AND userread = 0 AND confirm > 0");

                    $not = mysqli_fetch_assoc ($sql2);
                    $req = mysqli_fetch_assoc ($sql3);

                ?>
                    
                    
                    <li id="sign_in" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">HI, <?=ucwords($userlog['fullname']);?>

                        <?php 

                            if ($not['count'] > 0 || $req['count'] > 0  )  {
                                

                                echo '<span class="badge">new</span></a>';
                            }
                            else{

                                echo ' ';
                            }

                        ?>
                        
                    

                    
                    <ul class="dropdown-menu">
                    <li><a href="dashboard.php"><span class="ti-comment-alt"></span> Notification<?php 

                            if ($not['count'] > 0  || $req['count'] > 0 )  {
                                

                                echo '<span class="badge">!</span></a>';
                            }
                            else{

                                echo ' ';
                            }

                        ?></span></a></li>
                    <li><a href="logout.php"><span class="ti-power-off"></span> LOGOUT</a></li>
                   <?php } else { ?>
                    <li><a href="login.php"><i class="fa fa-user"></i> LOGIN</a></li>
                   <?php } ?>
                   </li>
        </ul>
    </div>
</nav>
