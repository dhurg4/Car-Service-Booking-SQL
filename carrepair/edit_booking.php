<?php
// Database connection
include 'db_connect.php'; // Includes the connection and starts/resumes the session
$conn = mysqli_connect($servername, $username, $password, $dbname);




// Get budgetID from query parameter
$bookingID = $_GET['bookingID'];
$booking = null;

// Retrieve budget details
if ($budgetID) {
    $sql = "SELECT * FROM booking WHERE bookingID = $bookingID";
    $result = $conn->query($sql);
    $booking = $result->fetch_assoc();
}

// Update budget information when form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $serviceID = $_POST['serviceID'];
    $date = $_POST['date'];
    $specialRequest = $_POST['specialRequest'];

    $updateSql = "UPDATE booking SET name='$name', email='$email', serviceID='$serviceID', 
                date='$date', specialRequest = '$specialRequest' WHERE bookingID = $bookingID";

    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Booking updated successfully!'); window.parent.location.reload();</script>";
    } else {
        echo "Error updating booking: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
</head>
<body>
<h2>Edit Booking</h2>

<?php if ($bookingID): ?>
    <form method="post" action="">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $booking['name']; ?>"><br>

        <label>Email</label>
        <input type="text" name="email" value="<?php echo $booking['email']; ?>"><br>

        <label>Service:</label>
        <select name="serviceID">
            <option value="1" <?php if ($booking['serviceID'] == '1') echo 'selected'; ?>>Service 1</option>
            <option value="2" <?php if ($booking['serviceID'] == '2') echo 'selected'; ?>>Service 2</option>
            <option value="3" <?php if ($booking['serviceID'] == '3') echo 'selected'; ?>>Service 3</option>
        </select><br>

        <label>Date</label>
        <input type="datetime-local" name="date" value="<?php echo $booking['date']; ?>"><br>

        <label>Special Request</label>
        <input type="text" name="specialRequest" value="<?php echo $booking['specialRequest']; ?>"><br>

        <button type="submit">Save</button>
    </form>
<?php else: ?>
    <p>Booking record not found.</p>
<?php endif; ?>

</body>
</html>
