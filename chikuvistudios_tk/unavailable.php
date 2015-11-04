<?php session_start();?>
<!DOCTYPE HTML>

<html>
	<head>
		<?php
            $myPage = 'index';
            include 'head.php';
        ?>
		<link href="assets/css/unavailable.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
    <?php
        include 'header.php';
    ?>

    <div class="container-fluid" id="cont">
        <div class="row">
            <div class="col-md-12 column">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h1 class="panel-title" id="Title">Page is Currently Unavailable</h1>
                    </div>
                    <div class="panel-body" style="background-color: darkslategray;">
                        <p id="smallTitle">This page in unavailable in the current prototype.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="logoFixed">
        <img src="/assets/images/rambo-logo-white.png" width="150" height="50" />
    </div>
    </body>
</html>