<?php
// Database connection
include 'db_connect.php'; // Includes the connection and starts/resumes the session
$conn = mysqli_connect($servername, $username, $password, $dbname);



// Get UserID from query parameter
$bookingID = $_GET['bookingID'];

// Delete user record
if ($bookingID > 0) {
    $sql = "DELETE FROM booking WHERE bookingID = $bookingID";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Booking record deleted successfully!'); window.location.href = 'update.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "bookingID : $bookingID";
    echo "Invalid UserID.";
}

$conn->close();
?>
