<?php
require 'function.php';

if (isset($_SESSION['login'])) {
    //sudah login
} else {
    //belum login
    header('location:login.php');
}