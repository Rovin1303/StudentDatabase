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

$id = $_POST['id'] ?? '';
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    echo '
    <html>
    <head>
        <title>Update Student</title>
        <link rel="stylesheet" href="edit.css">
    </head>
    <body>
        <div class="container">
            <h2>Update Student</h2>
            <form action="update.php" method="post">
                <input type="hidden" name="id" value="'.$row['id'].'">
                <input type="text" name="name" value="'.$row['name'].'" required><br>
                <input type="email" name="email" value="'.$row['email'].'" required><br>
                <input type="number" name="age" value="'.$row['age'].'" required><br>
                <input type="text" name="course" value="'.$row['course'].'" required><br>
                <button type="submit" class="btn">Update</button>
            </form>
            <a href="edit.html" class="btn back">Back</a>
        </div>
    </body>
    </html>';
} else {
    echo "<h4>No student found with ID: $id</h4>";
    echo "<a href='edit.html'>Try Again</a>";
}

$stmt->close();
$conn->close();
?>
