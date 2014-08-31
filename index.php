<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8" />

    <title>HomeSystem</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="icon" sizes="16x16 32x32 64x64" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicon-152.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicon-144.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicon-120.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon-114.png">
    <link rel="dns-prefetch" href="//ajax.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">

    <meta http-equiv="content-type" content="text/html" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Sascha Gering, Jan Jastrow" />

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="flot/jquery.flot.js"></script>
    <script type="text/javascript" src="flot/jquery.flot.time.js"></script>
    <script type="text/javascript" src="flot/jquery.flot.axislabels.js"></script>
    <script type="text/javascript" src="flot/jquery.flot.symbol.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/main.css" type="text/css" />
    <link rel="author" type="text/plain" href="/humans.txt" />
    <meta http-equiv="refresh" content="300">
</head>
<body>
<header class="clearfix">
    <a href="index.php"><img src="img/logo.svg" class="logo" /></a>
    <h1><a href="index.php">HomeSystem</a></h1>
    <nav>
        <ul>
            <li><a href="index.php?site=show_sensor_data">Temperaturüberwachung</a></li>
            <li><a href="index.php?site=show_sensor_management">Sensorverwaltung</a></li>
            <li><a href="index.php?site=camera">Kameraüberwachung</a></li>
        </ul>
    </nav>
</header>


<?
$file = $_GET['site'];
if(file_exists("inc/$file.php"))
{
    include("inc/$file.php");
}
else
{
    include("inc/main.php");
}
?>

</body>
</html>
