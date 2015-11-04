<html>
<head>
    <?php
        $myPage = 'main';
        include_once 'head.php';
    ?>
</head>

<body>
        <?php
        session_start(); // Starts session. If it has been started, session variable will be there
        include_once 'header.php';
        if( !isset($_SESSION['userLvl']) || ($_SESSION['userLvl'] != 0 && $_SESSION['userLvl'] != 1)) // if not admin, fuck you
        {
            include_once 'forbidden.php';
            exit;
        }
        ?>
        <link href="assets/css/main.css" rel="stylesheet" type="text/css" />
    <div class="container">

        <div class="row clearfix">
            <?php
            if($_SESSION['userLvl'] == 0 && strcmp($_SESSION['name'],"admin") == 0)
            echo "<div class='col-md-4 column'>";
                else
                echo "<div class='col-md-6 column'>";
            ?>
                <h2>
                    Manage Inventory
                </h2>
                <a href="/inventory.php">
                    <p align="center" class="imgBorder">
                        <img height="150px" src="assets/images/inventory.png" /> <br>
                    </p>
                </a>
            </div>
            <?php
            if($_SESSION['userLvl'] == 0 && strcmp($_SESSION['name'],"admin") == 0)
                echo "<div class='col-md-4 column'>";
            else
                echo "<div class='col-md-6 column'>";
            ?>
                <h2>
                    Manage Schedule
                </h2>
                <a href="/unavailable.php">
                    <p align="center" class="imgBorder">
                        <img height="150px" src="assets/images/schedule.png" /> <br>
                    </p>
                </a>
            </div>
            <?php if($_SESSION['userLvl'] == 0 && strcmp($_SESSION['name'],"admin") == 0)
                echo '<div class="col-md-4 column">
                        <h2> Manage Users (admin) </h2>
                        <a href="/admin/adminpanel.php">
                            <p align="center" class="imgBorder">
                                <img height="150px" src="assets/images/users.png" /> <br>
                            </p>
                        </a>
                      </div>';?>
        </div>
    </div>
	
	<div id="logoFixed">
		<img src="assets/images/rambo-logo-white.png" width="150" height="50" />
	</div>
    </body>
</html>