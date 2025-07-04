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

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$age = $_POST['age'];
$course = $_POST['course'];

$sql = "UPDATE students SET name=?, email=?, age=?, course=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisi", $name, $email, $age, $course, $id);

if ($stmt->execute()) {
    echo '
    <html>
    <head>
        <title>Update Success</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f7f8;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .container {
                background-color: #ffffff;
                padding: 30px 40px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
            h2 {
                color: green;
                margin-bottom: 20px;
            }
            a {
                display: inline-block;
                margin: 10px;
                padding: 10px 20px;
                text-decoration: none;
                color: white;
                background-color: #007BFF;
                border-radius: 5px;
                font-weight: bold;
                transition: background-color 0.3s ease;
            }
            a:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Student details updated successfully!</h2>
            <a href="edit.html">Edit Another Student</a>
            <a href="index.html">Back to Home</a>
        </div>
    </body>
    </html>';
} else {
    echo "Error updating record: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
