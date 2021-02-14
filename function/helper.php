<?php

    define("BASE_URL", "http://localhost/weshop/");

    // membuat fungsi rupiah
    function rupiah($nilai=0){
        $string = "Rp," . number_format($nilai);
        return $string;
    }