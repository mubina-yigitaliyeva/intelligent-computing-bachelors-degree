<?php

// cookie = Information about a user stored in a user's web-browser
//          targeted advertisimenets, browsing preferences, and
//          other non-sensitive data

// setcookie (name, value, expiration_time in seconds, file_path)
setcookie("fav_food", "pizza", time() - 0, "/");
setcookie("fav_drink", "coffee", time() + (86400 * 3), "/");
setcookie("fav_desert", "ice cream", time() + (86400 * 4), "/");

// deleting a cookie - set time to 0 or negative
//      setcookie("fav_food", "pizza", time() - 0, "/");

foreach ($_COOKIE as $key => $value) {
    echo "{$key} = {$value} <br>";
}

echo "<br>";

if (isset($_COOKIE["fav_food"])) {
    echo "Buy some {$_COOKIE["fav_food"]} !!!";
} else {
    echo "I don't know your favorite food";
}
