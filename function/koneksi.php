<?php

    $server = "https://digima.herokuapp.com/";
    $username = "root";
    $password = "";
    $database = "weshop";

    $koneksi = mysqli_connect($server, $username, $password, $database) or die("Koneksi database error !!");
    