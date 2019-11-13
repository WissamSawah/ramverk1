<h1 class="ip">Validate IP address</h1>
    <?php if (!isset($_GET["ip"])) : ?>
        <form method="get" action="">
            <div>
                    <input id="ip" type="text" name="ip" value="<?=$ip?>" required>
            </div>
            <div  role="onchange">
              Your IP address will be set by default
            </div>
            <button class="pl1" type="submit">Validate</button>
    <?php endif; ?>
</form>
    <?php if (isset($_GET["ip"])) : ?>
        <table>
        <thead>
            <tr>
              <th scope="col">Info</th>
              <th scope="col">Detalis</th>
            </tr>
            <tbody>
                <tr>
                <th scope="row">Validation</th>
                <td><?=$protocol?></td>
            </tr>
            <tr>
            <th scope="row">Host</th>
            <td><?=$host?></td>
        </tr>
        <tr>
        <th  scope="row">IP</th>
        <td id="ip"><?=$details["ip"]?></td>
        </tr>
        <tr>
        <th scope="row">Flag Emoji</th>
        <td><?=$details["location"]["country_flag_emoji"]?></td>
        </tr>
        <tr>
        <th scope="row">Continent code</th>
        <td><?=$details["continent_code"]?></td>
        </tr>
        <tr>
        <th scope="row">Continent name</th>
        <td><?=$details["continent_name"]?></td>
        </tr>
        <tr>
        <th scope="row">Countr code</th>
        <td><?=$details["country_code"]?></td>
        </tr>
        <tr>
        <th scope="row">Country</th>
        <td><?=$details["country_name"]?></td>
        </tr>
        <tr>
        <th scope="row">Region code</th>
        <td><?=$details["region_code"]?></td>
        </tr>
        <tr>
        <th scope="row">city</th>
        <td><?=$details["city"]?></td>
        </tr>
        <tr>
        <th scope="row">zip</th>
        <td><?=$details["zip"]?></td>
        </tr>
        <tr>
        <th  scope="row">Latitude</th>
        <td id="lat"><?=$details["latitude"]?></td>
        </tr>
        <tr>
        <th  scope="row">Longitude</th>
        <td id="lng"><?=$details["longitude"]?></td>
        </tr>
        <tr>
        <th scope="row">Capital</th>
        <td><?=$details["location"]["capital"]?></td>
        </tr>
        <tr>
        <th scope="row">Native langauage</th>
        <td><?=$details["location"]["languages"]["0"]["native"]?></td>
        </tr>
        <tr>
        <th scope="row">Country flag</th>
        <td><img src="<?=$details["location"]["country_flag"]?>" height="100px"></td>
        </tr>
        <tr>
        <th scope="row">Dial code</th>
        <td><?=$details["location"]["calling_code"]?></td>
        </tr>
        <tr>
        <th scope="row">Eu</th>
        <td><?=$details["location"]["is_eu"]?></td>
        </tr>
        <tr>
        <th scope="row">Map</th>
        <td id="map" style="width: 800px; height: 460px;"></td>
        </tr>

            </tbody>
        </thead>
    </table>
    <a href="validate"><button class="pl1">Back</button></a>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script type="text/javascript">
    var latPos = document.getElementById('lat').innerText;
    var lngPos = document.getElementById('lng').innerText;
    var ipAdress = document.getElementById('ip').innerText;
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
            ).addTo(map).bindPopup("CurrentIP: " + ipAdress);
            map.setView(new L.LatLng(latPos, lngPos), 13).addLayer(osm);
    }
}, 300);
</script>
    <?php endif; ?>
