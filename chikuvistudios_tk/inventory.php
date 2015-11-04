<!DOCTYPE HTML>

<html>
	<head>
		<?php
            $myPage = 'inventory';
            ob_start();
            include_once 'head.php';
        ?>
		<link href="/assets/css/inventory.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="assets/js/inline_actions.js"></script>

        <style>

            select#orderSelect
            {
                width:200px;
            }

        </style>
	</head>
	
	<body>
        <?php
        session_start(); // Starts session. If it has been started, session variable will be there

        if( !isset($_SESSION['userLvl']) || ($_SESSION['userLvl'] != 0 && $_SESSION['userLvl'] != 1)) // if not admin, fuck you
        {
            include_once 'forbidden.php';
            exit;
        }

        include 'header.php';
        require $_SERVER['DOCUMENT_ROOT'].'/../includes/db_connect.php';
        require $_SERVER['DOCUMENT_ROOT'].'/../includes/queries.php';


        if(isset($_GET["u"]))
        {
            $items = htmlspecialchars($_GET["u"]);

            switch($items)
            {
                case 1:
                    bootAlert('Item deleted!<br/>Successfully Updated Database<br/>','success');
                    break;
                case 2:
                    bootAlert('Cannot delete item.<br/>Database remains unchanged<br/>Contact system administrator.<br/>','danger');
                    break;
                case 3:
                    bootAlert('Item updated!.<br/>Successfully Updated Database<br/>','success');
                    break;
                case 4:
                    bootAlert('Cannot update item.<br/>Database remains unchanged<br/>Contact system administrator.<br/>','danger');
                    break;
                case 5:
                    bootAlert('Item added!<br/>Successfully Updated Database<br/>','success');
                    break;
                case 6:
                    bootAlert('Cannot add item.<br/>Database remains unchanged<br/>Contact system administrator.<br/>','danger');
                    break;
                default:
                    bootAlert('Unknown Error.','info');
                    break;
            }
        }



        ?>
        	<p id="title">Inventory</p>

        <div class="container-fluid" id="cont">
            <div class="row hidden-print" id="theButtons">
                <div class="col-md-4">
                    <input class="form-control" type="text" id="searching" name="searching" placeholder="search..." form="searchForm"/>
                </div>
                <div class="col-md-1">Order By</div>
                <div class="col-md-3">
                    <select class="form-control" form="searchForm" name="order">
                        <option value="none">None</option>
                        <option value="name">Name</option>
                        <option value="qty">Quantity</option>
                        <option value="status">Status</option>
                        <option value="mod">Last Modified By</option>
                        <option value="modDate">Last Modified Date</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control" form="searchForm" name="direction">
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <form method="post" action="" id="searchForm">
                        <input class="btn btn-primary" type="submit" name="search" align="center" value="Search">
                    </form>
                </div>
            </div>

            <div class="row hidden-print" id="theButtons">
                <div class="col-md-1">
                    <button class="btn btn-primary" type="button" align="center" id="add" onClick="addItem()">add</button>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-warning" type="button" allign="center" id="summaryReport" onclick="window.print()">summary report</button>
                </div>
            </div>

            <div class="row" id="theTable">
                <table class="table" cellpadding="5">
                    <thead>
                        <tr>
                            <th class="hidden-print">Select</th>
                            <th class="hidden-print">Modify</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Last Modified By</th>
                            <th>Last Modified Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_GET['search']) && strcmp($_GET['search'],"")!= 0)
                            {
                                getItems($bdd,htmlspecialchars($_GET["search"]),$_GET['order'],$_GET['dir']);
                            }
                            else if(isset($_GET['order']) && isset($_GET['dir']) )
							{
								if(strcmp($_GET['order'],"none") == 0 && strcmp($_GET['dir'],"desc") == 0)
									getItems($bdd,"","","");
								else
									getItems($bdd,"",$_GET['order'],$_GET['dir']);
							}
                                
                            else						
								getItems($bdd,"","","");
							
                                

                        ?>
                    </tbody>
                </table>

                <?php
                    if(isset($_POST['deleteItem']))
                    {
                        $response = deleteItem($bdd,$_POST['ID']);

                        if($response)
                            header("Location: inventory.php?u=1");
                        else
                            header("Location: inventory.php?u=2");
                    }

                    if(isset($_POST['update']))
                    {
                        $response = updateItem($bdd,$_POST['itemID'],$_POST['itemName'],$_POST['itemDesc'],$_POST['itemQty'],$_POST['itemStatus'],$_SESSION['id']);

                        if($response)
                            header("Location: inventory.php?u=3");
                        else
                            header("Location: inventory.php?u=4");
                    }

                    if(isset($_POST['addItem']))
                    {
                        $response = addItem($bdd,$_POST['itemName'],$_POST['itemDesc'],$_POST['itemQty'],$_POST['itemStatus'],$_SESSION['id']);

                        if($response)
                            header("Location: inventory.php?u=5");
                        else
                            header("Location: inventory.php?u=6");

                    }
                    else if(isset($_POST['cancel']))
                        header("Location: inventory.php");

                    if(isset($_POST['search']))
                    {
                        header("Location: inventory.php?search=".$_POST['searching']."&order=".$_POST['order']."&dir=".$_POST['direction']);
                    }

                    ob_flush();
                ?>
            </div>
        </div>

        <div class="hidden-print" id="logoFixed">
            <img src="assets/images/rambo-logo-white.png" width="150" height="50" />
        </div>
        <!--footer class="hidden-print" align="center">
            <p>&#169;2015 - Team RAMBo - <a href="contact.htm">contact us</a></p>
        </footer-->

    </body>

</html>