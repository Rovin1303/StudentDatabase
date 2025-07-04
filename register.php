<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "studentdb";
$port = 4306;

$conn = new mysqli($servername, $username, $password, $database, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$age = $_POST['age'] ?? '';
$course = $_POST['course'] ?? '';

if (!empty($name) && !empty($email) && !empty($age) && !empty($course)) {
    $stmt = $conn->prepare("INSERT INTO students (name, email, age, course) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $email, $age, $course);

    if ($stmt->execute()) {
        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Success</title>
            <link rel='stylesheet' href='register.css'>
        </head>
        <body>
        <div class='container'>
            <h2>Student Registered Successfully</h2>
            <a href='register.html' class='btn'>Register Another</a>
            <a href='index.html' class='btn back'>Back to Home</a>
        </div>
        </body>
        </html>";
    } else {
        echo "
        <h3>Error: " . $stmt->error . "</h3>
        <a href='register.html'>Try Again</a>";
    }

    $stmt->close();
} else {
    echo "
    <h3>Click here to register.</h3>
    <a href='register.html' class='btn'>Register</a>";
}

$conn->close();
?>
