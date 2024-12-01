<?php
$servername = "localhost";
$username = "root"; // default username for XAMPP
$password = "Paet20Wz6m5"; // default password for XAMPP
$dbname = "medicines_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicineName = $_POST['medicine_name'];
    if (!empty($medicineName)) {
        $stmt = $conn->prepare("INSERT INTO medicines (name) VALUES (?)");
        $stmt->bind_param("s", $medicineName);
        $stmt->execute();
        $stmt->close();
        header("Location: table.php"); // Redirect to the table page after submission
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medicine</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <style>
        body {
            display: flex;
        }
        .sidenav {
            width: 250px;
            background-color: #f4f4f4;
            padding: 15px;
            height: 100vh;
        }
        .sidenav a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }
        .sidenav a:hover {
            background-color: #ddd;
        }
        .main {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidenav">
        <h2>Dashboard</h2>
        <a href="form.php">Medicine Form</a>
        <a href="table.php">Medicine Table</a>
    </div>
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Upload Medicine</h1>
            <form action="" method="POST">
                <div class="field">
                    <label class="label">Medicine Name</label>
                    <div class="control">
                        <input class="input" type="text" name="medicine_name" required>
                    </div>
                </div>
                <div class="control">
                    <button class="button is-link" type="submit">Upload Medicine</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>

<?php
$conn->close();
?>