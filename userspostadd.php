<?php 

include('importy/bazadanych.php');
include('importy/funkcje.php');
include('importy/config.php');


include('importy/header.php');


//var_dump($_SESSION)
?>
<link rel="stylesheet" href="css/texteditor.css">
<div class="container width-7">
            <h1 class="display-1">Dodaj post</h1>
            <form method="post" id="form" action="processpost.php">
                <!-- title input -->
                <div class="form-outline mb-4">
                    <input placeholder="" required type="text" id="title" class="form-control" name="title"/>
                    <label class="form-label" for="email">Tytuł</label>
                </div>
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
                        <!-- <li class="tool">
                            <button type="button" onclick='formatText("underline")' class="tool-btn onoff">
                                <i class="fas fa-underline"></i>
                            </button>
                        </li> -->
                        <li class="tool">
                            <button type="button" onclick='formatText("headone")' class="tool-btn">
                                <i class="fas fa-header">1</i>
                            </button>
                        </li>
                        <li class="tool">
                            <button type="button" onclick='formatText("headtwo")' class="tool-btn">
                                <i class="fas fa-header">2</i>
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
                
                <!-- content input
                <div class="form-outline mb-4">
                    <input placeholder="" required type="" id="content" class="form-control" name="content"/>
                    <label class="form-label" for="content">Content</label>
                </div> -->

                <!-- private select -->
                <div class="form-outline mb-4">
                    <select name="private" id="private" class="form-select">
                        <option value="0">Publiczny</option>
                        <option value="1">Prywatny</option>
                    </select>
                </div>
                
                <!-- date input -->
                <div class="form-outline mb-4">
                    <input placeholder="" required type="date" id="date" class="form-control" name="date">
                    <label class="form-label" for="date">Data</label>
                </div>

                <!-- Submit button -->
                <button id='przeslij' class="btn-accept">Dodaj post</button>
            </form>
    <script defer src="js/texteditor.js"></script>
</div>

<?php
include("importy/footer.php");
?>