<?php

$header = '
<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <title>Temperaturüberwachung</title>
    <link rel="dns-prefetch" href="//ajax.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <meta http-equiv="content-type" content="text/html" />
    <meta name="author" content="Sascha Gering, Jan Jastrow" />
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="/js/flot/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="flot/jquery.flot.js"></script>
    <script type="text/javascript" src="flot/jquery.flot.time.js"></script>
    <script type="text/javascript" src="flot/jquery.flot.axislabels.js"></script>
    <script type="text/javascript" src="flot/jquery.flot.symbol.js"></script>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/main.css" type="text/css" />
</head>';

$body_before = '
<header>
    <h1><a href="index.php">Temperaturüberwachung</a></h1>
</header>
<article>
    <form class="newdata" action="index.php" method="GET">
        <p>Zeige letzte</p>
        <input class="newdata--enter" type="number" name="limit" value="30" />
        <p>Werte.</p>
        <input class="newdata--submit" type="submit" name="submit" value="Aktualisieren" />
    </form>
</article>
<article>
    <ul class="last">
        <li><a href="?limit=288">Zeige die letzten 24h</a></li>
        <li><a href="?limit=144">Zeige die letzten 12h</a></li>
        <li><a href="?limit=24">Zeige die letzten 2h</a></li>
    </p>
</article>
';
$body_after = '
';

?>
