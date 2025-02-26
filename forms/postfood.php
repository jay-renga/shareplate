<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "share_plate_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    //print_r($_POST);
    $name = $_POST['name'];
    $phone = $_POST['contact_phone'];
    $amount = $_POST['amount'];
    $type_of_food = $_POST['type_of_food'];
    $time_of_preparation = $_POST['time_of_preparation'];
    $location = $_POST['location'];
    $message = $_POST['message'];
    $created = date('Y-m-d H:i:s');
    $photo = "";
    
    // Handle file upload
    if (!empty($_FILES['photo']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo = $target_file;
        }
    }

    $sql = "INSERT INTO food_items (contact_name, contact_phone, created_on, quantity, type_of_food, time_of_preparation, location, message, photo)
            VALUES ('$name', '$phone', '$created', '$amount', '$type_of_food', '$time_of_preparation', '$location', '$message', '$photo')";

    if ($conn->query($sql) === TRUE) {
        echo "OK";   
      
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
