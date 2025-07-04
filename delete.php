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
$message = '';
$success = false;

if (!empty($name)) {
    $stmt = $conn->prepare("DELETE FROM students WHERE name = ?");
    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $message = "Student deleted successfully.";
            $success = true;
        } else {
            $message = "No student found with that name.";
        }
    } else {
        $message = "Error deleting student: " . $stmt->error;
    }
    $stmt->close();
} else {
    $message = "Please provide a name.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Student Result</title>
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
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: <?php echo $success ? 'green' : 'red'; ?>;
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
        <h2><?php echo $message; ?></h2>
        <a href="delete.html">Delete Another Student</a>
        <a href="index.html">Back to Home</a>
    </div>
</body>
</html>
