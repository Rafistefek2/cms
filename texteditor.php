<?php 

include('importy/bazadanych.php');
include('importy/funkcje.php');
include('importy/config.php');


include('importy/header.php');


//var_dump($_SESSION)
?>
<link rel="stylesheet" href="css/texteditor.css">
<div class="container width-7">
    <div class="toolbar">
        <ul class="tool-list">
            <li class="tool">
                <button type="button" onclick='formatText("bold")' class="tool-btn onoff">
                    <i class="fas fa-bold"></i>
                </button>
            </li>
            <li class="tool">
                <button type="button" onclick='formatText("italic")' class="tool-btn onoff">
                    <i class="fas fa-italic"></i>
                </button>
            </li>
            <li class="tool">
                <button type="button" onclick='formatText("underline")' class="tool-btn onoff">
                    <i class="fas fa-underline"></i>
                </button>
            </li>
            <li class="tool">
                <button type="button" onclick='formatText("insertOrderedList")' class="tool-btn">
                    <i class="fas fa-list-ol"></i>
                </button>
            </li>
            <li class="tool">
                <button type="button" onclick='formatText("insertUnorderedList")' class="tool-btn">
                    <i class="fas fa-list-ul"></i>
                </button>
            </li>
            <li class="tool">
                <button type="button" onclick='formatText("createlink")' class="tool-btn">
                    <i class="fas fa-link"></i>
                </button>
            </li>
            <!-- <li class="tool">
                <button type="button" onclick='formatText("unlink")' class="tool-btn">
                    <i class="fas fa-link-slash"></i>
                </button>
            </li> -->
        </ul>
    </div>
    <div id="output" contenteditable="true"></div>
    <script defer src="js/texteditor.js"></script>
</div>

<?php
include("importy/footer.php");
?>