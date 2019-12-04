<h1>Get weather from IP {JSON}</h1>


            <form method="post">
                <div>
                  <input class="form-check-input" type="radio" name="time" id="exampleRadios1" value="past" checked>
                  <label for="exampleRadios1">
                    Last 30 days
                </label><br>
                </div>
                <div>
                  <input type="radio" name="time" id="exampleRadios2" value="future">
                  <label for="exampleRadios2">
                    Next week
                  </label>
                </div>
                <br>

                <div>
                <input  type="text" name="ip" value="<?= $currentIp ?>" placeholder="Your IP address here" required>
            </div>
            <br>

            <button class="pl1" type="submit">Get JSON</button>
        </form>


        <h4> Test routes </h4>

        <p>My Home IP-address{JSON}</p>
        <p><a href="weatherjson/weatherCheck?time=past&ip=213.67.74.185">213.67.74.185</a></p>
        <p><img title="dbwebb" alt="dbwebb" src="image/dbwebb.png" width= "30" height= "30"/>Dbwebb IP-address{JSON}</p>
        <p><a href="weatherjson/weatherCheck?time=past&ip=194.47.150.9">194.47.150.9</a></p>
        <p>Facebook IP-address{JSON}</p>
        <p><a href="weatherjson/weatherCheck?time=past&ip=31.13.72.36">31.13.72.36</a></p>
        <p>LinkedIn IP-address{JSON}</p>
        <p><a href="weatherjson/weatherCheck?time=past&ip=108.174.10.10">108.174.10.10</a></p>
        <p>BTH IP-address{JSON}</p>
        <p><a href="weatherjson/weatherCheck?time=past&ip=213.52.129.125">213.52.129.125</a></p>
