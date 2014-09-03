<h1>Kameraüberwachung</h1>
<?php
if ($debugmode = TRUE) {
echo "<p class='msg__inline debug'>Schreibrechte von /tmp/: ".substr(sprintf('%o', fileperms('./tmp')), -3)."</p>";
}
if (substr(sprintf('%o', fileperms('./tmp')), -3) != 775) {
echo "<p class='msg__inline error'>Ordner /tmp/ hat die falschen Schreibrechte (".substr(sprintf('%o', fileperms('./tmp')), -3)."). Bitte auf '775' ändern.</p>";
}
?>
<p>A new picture every 11 seconds (reloads automatically)</p>
<div class="frame">
    <iframe src="inc/camera_iframe.php" width="768" height="576" scrolling="no"></iframe>
</div>
