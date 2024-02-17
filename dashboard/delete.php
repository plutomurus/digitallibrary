<?php

require_once "action.php";

$id = $_GET["id"];

$data = new Book();

$success = $data->Delete($id);

if($success) {
    echo "
        <script>
            window.location.href='index.php?page=buku';
        </script>
    ";
}