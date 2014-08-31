<?php
$offline = FALSE;
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="refresh" content="11">
    <style>
    *, *::before, *::after {
        margin: 0;
        padding: 0;
    }

    body {
        background: #2b2b2b;
        background-size: 768px 576px;
    }

    img {
        max-width: 100%;
    }
    </style>
</head>
<body>
<?php

$filename = './tmp/cam1_resized.jpg';
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
    echo '<img style="width: 768; height: 576;" src="'.$filename.'?'.time().'" />';
}

?>
</body>
</html>
