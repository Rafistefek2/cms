<?php
include("importy/bazadanych.php");
include("importy/config.php");

if ($connect->connect_error) {
    die('Database connection failed: ' . $connect->connect_error);
}

// Fetch all chat messages
$result = $connect->query('SELECT * FROM chat JOIN users ON users.ID = chat.author ORDER BY adddate DESC');

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //echo $row['username'] . ": " . $row['content'] . "<br>";
        echo '<div class="mess">
                        <div class="messautor">'. $row['username'] .':&nbsp</div>
                        <div class="messcontent">'. $row['content'] .'</div>
            </div>';
    }
}
?>