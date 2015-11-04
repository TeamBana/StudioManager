<?php if (!isset($_SESSION['userLvl'])) exit; ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Chikuvi Studio</a>
        </div>
        <div class="collapse navbar-collapse nav-tabs" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?php if ($myPage=='main') echo 'class="active"';?>> <a href="/main.php">Home</a></li>
                <li <?php if ($myPage=='inventory') echo 'class="active"';?>><a href="/inventory.php">Inventory</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle <?php if ($myPage=='inventory') echo ' active';?> " data-toggle="dropdown" role="button" aria-expanded="false">Schedule <span class="caret"></span></a>
                    <ul class="dropdown-menu dp-dark" role="menu">
                        <li><a href="/unavailable.php">Week View</a></li>
                        <li><a href="/unavailable.php">Full View</a></li>
                        <li class="divider"></li>
                        <li><a href="/unavailable.php">Add Event</a></li>
                    </ul>
                </li>
                <li <?php if ($myPage=='admin') echo 'class="active"'; if ( $_SESSION['userLvl'] != 0)
                    echo ' hidden';?>> <a href="/admin/adminpanel.php">Users</a></li>
            </ul>
            <!--
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form-->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hello, <?php echo $_SESSION['ezName'];?> <span class="caret"></span></a>
                    <ul class="dropdown-menu dp-dark" role="menu">
                        <li><a href="/unavailable.php">Change Account Info</a></li>
                        <li><a href="/unavailable.php">Contact Admin</a></li>
                        <li class="divider"></li>
                        <li><a href="/index.php?l=1">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>