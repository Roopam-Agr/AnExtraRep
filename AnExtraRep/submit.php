<?php

if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $weight = $_POST["weight"];
    $email = $_POST["email"];
    $health_report = $_FILES["health_report"]["name"];

    $conn = mysqli_connect("localhost", "root", "", "healthreport");

    $sql = "INSERT INTO users (name, age, weight, email, health_report) VALUES ('$name', '$age', '$weight', '$email', '$health_report')";

    mysqli_query($conn, $sql);

    $email = $_GET["email"];
    $sql = "SELECT health_report FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $health_report = $row["health_report"];
        header("Content-type: application/pdf");
        header("Content-disposition: attachment; filename=$health_report");
        echo $health_report;
    } else {
        echo "No health report found for the given email ID.";
    }

    mysqli_close($conn);
}
