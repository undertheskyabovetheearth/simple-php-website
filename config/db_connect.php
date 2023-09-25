<?php

    $conn = mysqli_connect('localhost', 'root', '', 'pizzaria');

    if(!$conn) {
        echo 'Connection error' . mysqli_connect_error();
    }