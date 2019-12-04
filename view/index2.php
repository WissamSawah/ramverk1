<h1>Get weather from IP</h1>

<div class="jumboron">
    <?php if (isset($_GET["ip"])) : ?>
        <h2><?= $weather[0]["timezone"]?></h2>
        <table>
            <?php if ($currentIp !== null) : ?>
            <thead>
                <tr>
                    <th scope="col">Day</th>
                    <th scope="col">Date</th>
                    <th scope="col">Summary</th>
                    <th scope="col">Temperature</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($weather as $key => $value) : ?>
                <tr>
                    <th scope="row"><?= gmdate("l", $value["currently"]["time"]) ?></th>
                    <td><?= gmdate("j M-Y", $value["currently"]["time"]) ?></td>
                    <td><?= $value["currently"]["summary"] ?></td>
                    <td><?= $value["currently"]["temperature"] ?>°</td>

                    <td style="display: none;" id="lat"><?= $value["latitude"] ?></td>
                    <td style="display:none;" id="lng"><?= $value["longitude"] ?></td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div id="map" style="width: 800px; height: 460px;"></div>


            <?php endif; ?>

        <a href="weather"><button class="btn btn-primary btn-lg btn-block">Go back</button></a>


    <?php endif; ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script type="text/javascript">
    var latPos = document.getElementById('lat').innerText;
    var lngPos = document.getElementById('lng').innerText;
    // var ipAdress = document.getElementById('ip').innerText;
    var locationMarker = L.icon({
        iconUrl: 'img/location.png',
        iconSize:     [24, 24],
        iconAnchor:   [12, 12],
        popupAnchor:  [0, 0]
    });
    setTimeout(() => {
        if (latPos && lngPos) {
            var map = new L.Map('map');
            var osUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                osmAttrib = 'Map data &copy; 2018 OpenStreetMap contributors',
                osm = new L.TileLayer(osUrl, { maxZoom: 18, attribution: osmAttrib });
            L.marker(
                [latPos, lngPos],
                {icon: locationMarker}
            ).addTo(map).bindPopup("CurrentIP: ");
            map.setView(new L.LatLng(latPos, lngPos), 13).addLayer(osm);
    }
}, 300);
</script>
    <?php if (!isset($_GET["ip"])) : ?>
        <form method="get" action="">
            <div role="alert">
              Get current weather with future weather (up to 7 days) or with previous weather (up to 30 days ago).
            </div>
            <br>

              <input type="radio" name="time" id="exampleRadios1" value="past" checked>
              <label for="exampleRadios1">
                Last 30 days
              </label>
              <br>
              <input type="radio" name="time" id="exampleRadios2" value="future">
              <label for="exampleRadios2">
                Next Week
              </label>
              <br>
              <br>
              <input type="text" name="ip" value="<?= $currentIp ?>" placeholder="Your IP address here" required>
              <br>
              <br>


            <button class="pl1" type="submit">Check weather</button>

        </form>

    <?php endif; ?>

</div>
