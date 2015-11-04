<div class="row clearfix hidden-print">
        <div>
            <div id="imgUnderText">
                <script type="text/javascript">
                    var random = randInt(3);
                    document.write("<img width='100%' src='/assets/images/headers-colored" + random + ".png'/>");
                </script>
            </div>
            <?php
            if ( !isset($_SESSION['userLvl']) ) {
                echo '<style> #imgUnderText {margin-top:0px;} </style>';
            }
            elseif( $_SESSION['userLvl'] == 0 || $_SESSION['userLvl'] == 1) // if not admin, fuck you
                include'navbar.php';
            ?>
        </div>
    </div>