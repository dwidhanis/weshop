<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $level = "customer";
    $status = "on";
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];


    unset($_POST['password']);
    unset($_POST['re_password']);
    $dataForm = http_build_query($_POST);

    if (empty ($nama_lengkap) || empty($email) || empty($alamat) || empty($password)){
        header("location: ".BASE_URL."index.php?page=register&notif=require&$dataForm");
    }elseif($password != $re_password) {
        header("location: ".BASE_URL."index.php?page=register&notif=password&$dataForm");

    }else{
        mysqli_query($koneksi, "INSERT INTO user (level, nama, email, phone, alamat, password, status)
                                        VALUES ('$level', '$nama_lengkap', '$email', '$phone', '$alamat', '$password', '$status')");
    }
