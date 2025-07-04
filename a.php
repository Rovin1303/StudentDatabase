<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <link rel="stylesheet" href="students.css">
</head>
<body>
    <div class="container">
        <h2>Registered Students</h2>
        <div id="students-table">
            <?php 
                include 'students.php'; 
            ?>
        </div>
        <a href="index.html" class="btn">Back to Home</a>
    </div>
</body>
</html>
