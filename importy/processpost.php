<?php
// Get the string from the query parameter
include("funkcje.php");
Zaloguj_sie_zeby_odwiedzic();

if (isset($_GET['data'])) {
    # code...
}
$data = $_GET['data'] ?? 'No data received';

var_dump($data);

// $file = fopen("../usersposts/" . $_SESSION['id'] . "/example.md", "w");
// fwrite($file, $data);
// fclose($file);



require 'Parsedown.php'; // Include Parsedown library

$mdFile = 'example.md';

if (file_exists($mdFile)) {
    $content = file_get_contents($mdFile);

    $Parsedown = new Parsedown();
    $htmlContent = $Parsedown->text($content); // Convert Markdown to HTML

    echo $htmlContent; // Output rendered HTML
} else {
    echo "Markdown file not found.";
}
?>