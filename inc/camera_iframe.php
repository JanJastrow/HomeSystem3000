<?php
$offline = FALSE;
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="refresh" content="11">
    <link rel="stylesheet" href="../css/main.min.css" type="text/css" />
</head>
<body class="iframe">
<?php

$filename = '../tmp/cam1_resized.jpg';
$now = date(time());
$filedate = date(filemtime($filename));

/* Debug
echo $now."<br />";
if (file_exists($filename)) {
    echo $filedate."<br />";
}
echo ($now - $filedate);
*/

if (($now - $filedate) > 30 | $offline == TRUE) {
    echo '<img src="../img/cam_offline.jpg" />';
} else {
    echo '<img src="'.$filename.'?'.time().'" />';
}

?>
</body>
</html>
