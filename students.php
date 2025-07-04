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

$sql = "SELECT id, name, email, age, course, registered_at FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Age</th><th>Course</th><th>Registered At</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["id"]) . "</td>
                <td>" . htmlspecialchars($row["name"]) . "</td>
                <td>" . htmlspecialchars($row["email"]) . "</td>
                <td>" . htmlspecialchars($row["age"]) . "</td>
                <td>" . htmlspecialchars($row["course"]) . "</td>
                <td>" . htmlspecialchars($row["registered_at"]) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No students found.</p>";
}

$conn->close();
?>
