<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 class="head-txt">Enter your Url:</h1>
    <form style="margin: auto;">
        <p><input style="width:500px" type="url" name="url" required /></p>
        <p><input class="btn" type="submit" /></p>
    </form>

    <?php if ($shorts) { ?>
        <h1 class="shrt">Shortened Urls:</h1>
        <p>
        <table>
        <?php foreach ($shorts as $short) {
            $url = $short['short_url'];
            $href = $base_url . $url;
            echo "<tr><td><p><a target='_blank' href='$href'>$base_url$url</a></p></td></tr>";
        }
    }
        ?>

        </table>
        </p>

</body>

</html>