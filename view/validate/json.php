<h1>Validate IP address {JSON}</h1>

<form class="form-signin" method="get">
    <div >
            <input type="text" name="ip" placeholder="Your IP" required>
    </div>
    <button class="pl1"  type="submit">Validate</button>
</form>

    <h4> Test routes </h4>

    <p>My Home IP-address{JSON}</p>
    <p><a href="?ip=213.67.74.185">213.67.74.185</a></p>
    <p><img title="dbwebb" alt="dbwebb" src="image/dbwebb.png" width= "30" height= "30"/>Dbwebb IP-address{JSON}</p>
    <p><a href="?ip=194.47.150.9">194.47.150.9</a></p>
    <p>Facebook IP-address{JSON}</p>
    <p><a href="?ip=31.13.72.36">31.13.72.36</a></p>
    <p>LinkedIn IP-address{JSON}</p>
    <p><a href="?ip=108.174.10.10">108.174.10.10</a></p>
    <p>BTH IP-address{JSON}</p>
    <p><a href="?ip=213.52.129.125">213.52.129.125</a></p>



    <h4>Result In JSON</h4>
    <div class="codey">
        <code class="jsonc">
            <?php
            if (isset($_GET["ip"])) {
                echo json_encode($json, JSON_PRETTY_PRINT);
            }
            ?>
        </code>
