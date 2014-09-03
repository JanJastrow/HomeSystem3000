<h1>Kameraüberwachung</h1>
<?php
echo "<div class='debug'><strong>Debug:</strong> Schreibrechte auf /tmp/: ".substr(sprintf('%o', fileperms('./tmp')), -3)."</div>";
?>
<p>A new picture every 11 seconds (reloads automatically)</p>
<div class="frame">
    <iframe src="inc/camera_iframe.php" width="768" height="576" scrolling="no"></iframe>
</div>
<p>More text!</p>
