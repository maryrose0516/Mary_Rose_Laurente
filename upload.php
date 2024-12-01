<?php
$servername = "localhost";
$username = "root"; 
$password = "Paet20Wz6m5"; 
$dbname = "medicines_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['medicine_file'])) {
    $fileName = $_FILES['medicine_file']['name'];
    $fileTmpName = $_FILES['medicine_file']['tmp_name'];
    $fileSize = $_FILES['medicine_file']['size'];
    $fileError = $_FILES['medicine_file']['error'];
    $fileType = $_FILES['medicine_file']['type'];

    // Check for errors
    if ($fileError === 0) {
        if ($fileSize < 1000000) { // Limit file size to 1MB
            $fileDestination = 'uploads/' . $fileName; // Ensure 'uploads' directory exists
            move_uploaded_file($fileTmpName, $fileDestination);
            echo "File uploaded successfully!";
        } else {
            echo "File size exceeds limit.";
        }
    } else {
        echo "Error uploading file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Medicine File</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Upload Medicine File</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="field">
                    <label class="label">Select File</label>
                    <div class="control">
                        <input class="input" type="file" name="medicine_file" required>
                    </div>
                </div>
                <div class="control">
                    <button class="button is-link" type="submit">Upload File</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
