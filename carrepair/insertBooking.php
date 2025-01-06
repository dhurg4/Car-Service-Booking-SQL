<?php
// Database connection
include 'db_connect.php'; // Includes the connection and starts/resumes the session
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Collect form data
$name = $_POST['name'];
$email = $_POST['email'];
$serviceID = $_POST['serviceID'];
$date = $_POST['date'];
$specialRequest = $_POST['specialRequest'];


// Insert into booking table
$sql = "INSERT INTO booking (name, email, serviceID, date, specialRequest) VALUES ('$name', '$email', '$serviceID', '$date', '$specialRequest')";


if (isset($_POST['date']) && !empty($_POST['date'])) {
    $date = htmlspecialchars($_POST['date']); // Sanitize input
    echo "Received Date: $date";
} else {
    echo "Date field is empty!";
}


if ($conn->query($sql) === TRUE) {
    $bookingID = $conn->insert_id;
    // Redirect with JavaScript and show a success message
    echo "<script>
        alert('Record entered successfully!');
        window.location.href = 'index.php';
        </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
