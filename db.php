<?php
// db.php
// Yeh file data ko 'database.json' file mein save/karegi. 
// Real MySQL ki jagah humne JSON use kiya hai taaki yeh code kahin bhi chale bina server config ke.

 $filename = 'database.json';

// Data load karne ka function
function getData() {
    global $filename;
    if (!file_exists($filename)) {
        return ['users' => [], 'cart' => [], 'wishlist' => []];
    }
    $json = file_get_contents($filename);
    return json_decode($json, true);
}

// Data save karne ka function
function saveData($data) {
    global $filename;
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
}

// Session start karo har page par
session_start();
?>