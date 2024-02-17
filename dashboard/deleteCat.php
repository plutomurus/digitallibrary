<?php

require_once "action.php";

$id = $_GET["id"];

$data = new Category();

$success = $data->Delete($id);

if($success) {
    header("location:index.php?page=kategori");
}