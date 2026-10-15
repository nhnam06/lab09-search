
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Search Results</title>
</head>
<body>

    <h1>Car Search Results</h1>

    <?php
    require_once("settings.php");

    // Connect to MySQL database
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        die("<p>Database connection failed.</p>");
    }

    // Check if the model was submitted
    if (isset($_GET['model']) && trim($_GET['model']) !== '') {

        // Get and sanitise the search input
        $model = mysqli_real_escape_string($conn, trim($_GET['model']));

        // Search for matching car models
        $sql = "SELECT * FROM cars WHERE model LIKE '%$model%'";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {

            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Make</th>";
            echo "<th>Model</th>";
            echo "<th>Price</th>";
            echo "<th>Year</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['car_id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['make']) . "</td>";
                echo "<td>" . htmlspecialchars($row['model']) . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['yom'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";

        } elseif ($result) {
            echo "<p>No matching cars found.</p>";
        } else {
            echo "<p>Error running search query.</p>";
        }

    } else {
        echo "<p>Please enter a model to search.</p>";
    }

    mysqli_close($conn);
    ?>

    <p><a href="search_form.php">Back to Search</a></p>

</body>
</html>
