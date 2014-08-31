<script>
<? include("gen_data.php"); ?>
</script>
<article>
    <form class="newdata" action="?site=show_sensor_data" method="POST">
        <p>Zeige letzte</p>
        <input class="newdata--enter" type="number" name="limit" value="30" />
        <p>Werte.</p>
        <input class="newdata--submit" type="submit" name="submit" value="Aktualisieren" />
    </form>
</article>
<article>
    <ul class="last">
        <li><a href="?site=show_sensor_data&limit=288">Zeige die letzten 24h</a></li>
        <li><a href="?site=show_sensor_data&limit=144">Zeige die letzten 12h</a></li>
        <li><a href="?site=show_sensor_data&limit=24">Zeige die letzten 2h</a></li>
    </p>
</article>

<div id="flot-placeholder"></div>