<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Chikuvi Studio</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<script type="text/javascript" src="/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
<!--script src="assets/js/less-1.3.3.min.js"></script>

<script type="text/javascript" src="/assets/js/scripts.js"></script>

<link rel="stylesheet/less" href="assets/less/bootstrap.less" type="text/css" />
<link rel="stylesheet/less" href="assets/less/responsive.less" type="text/css"/-->
<!--append ‘#!watch’ to the browser URL, then refresh the page. -->

<link href="http://chikuvistudios.tk/assets/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="/assets/js/html5shiv.js"></script>
<![endif]-->

<!-- Fav and touch icons
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="img/favicon.png"> -->

<link href="/assets/css/header.css" rel="stylesheet" type="text/css" />
<script src="/assets/js/randomHeader.js" type="text/javascript"></script>

<?php

function bootAlert($msg, $type) {
    echo '  <div class="alert alert-'.$type. ' alert-dismissible" role="alert">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button> '.$msg.'</div>';
}