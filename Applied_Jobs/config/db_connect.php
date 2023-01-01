<?php

    $conn = mysqli_connect('localhost', 'root', '', 'applied_jobs');

    if (!$conn) {
        echo 'Connection error:' . mysqli_connect_error();
    }

?>