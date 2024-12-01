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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicineName = $_POST['medicine_name'];
    if (!empty($medicineName)) {
        $stmt = $conn->prepare("INSERT INTO medicines (name) VALUES (?)");
        $stmt->bind_param("s", $medicineName);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch medicines
$result = $conn->query("SELECT * FROM medicines");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicines Management</title>
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
        <a href="#table.php">Medicine Table</a>
    </div>

    <div class="main">
        <section class="section" id="form">
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
        </section>

        <section class="section" id="table">
            <h2 class="subtitle">Uploaded Medicines</h2>
            <table class="table is-striped is-fullwidth">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="button is-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>

<?php
$conn->close();
?>
