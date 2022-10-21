<?php
require_once("./settings/constants.php");
require_once("./settings/settings.php");
require_once("./functions/functions.php");

$api_query = API_URL . $api['resource'] . "/" . $api['endpoint'] . "?api_key=" . API_KEY . "&";
$api_query .= "limit=" . $api["limit"] . "&rating=" . $api["rating"];

if ($api["endpoint"] == "search") {
    $api_query .= "&";
    $api_query .= "offset=" . $api["offset"] . "&lang=" . $api["lang"];
}

$api_call = json_decode(file_get_contents($api_query), $flags = JSON_PRETTY_PRINT);
// $api_call = json_encode(file_get_contents($api_query), JSON_PRETTY_PRINT);

$img_array = $api_call["data"];

// pr($img_array[0]["images"]["preview_webp"]);

echo "<div class='row'>\r\n";
for ($i = 0; $i < $api["limit"]; $i++) {
    // echo ($i % 2 == 0 ? "<div class='col-lg-6 col-md-12 mb-4 mb-lg-0'>\r\n" : "<div class='col-lg-6 mb-4 mb-lg-0'>");
    echo "<div class='col-lg-2 col-md-4 col-sm-6 col-xs-1mb-4 mb-lg-0'>\r\n";
    $img = $img_array[$i]["images"]["preview_webp"]["url"];
    $desc = $img_array[$i]["title"];
    echo "<img src='{$img}' class='img-fluid w-100 shadow-1-strong rounded mb-4' alt='{$desc}' />\r\n";
    echo "</div>\r\n";
}
echo "</div>\r\n";
