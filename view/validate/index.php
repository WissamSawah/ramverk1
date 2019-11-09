<h1 class="ip">Validate IP address</h1>



    <form method="get" action="">
        <div>
                <input type="text" name="ip" placeholder="Your IP" required>
        </div>
        <button class="pl1"  type="submit">Validate</button>
    </form>
</div>
    <?php if (isset($_GET["ip"])) : ?>
        <h4>Result</h4>
        <p><?= $protocol ?></p>
        <h4>Host</h4>
        <p><?= $host ?></p>
    <?php endif; ?>
