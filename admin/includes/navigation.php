
<?php
require_once '../includes/config.php';
require_once '../funcs/function.php';
?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand" href="index.php">
           <P>SOKONI</P>
        </a>
        <a class="navbar-brand">
            <p> <b>PLATFORM</b> | DASHBOARD</p>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">HOME</a></li>
            <li id="sign_in"><a> <i class="fa fa-user"></i> Hi, <?=ucwords($user);?></a></li>
        </ul>
    </div>
</nav>