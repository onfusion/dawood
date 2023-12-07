<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $confirm_delete = $_POST['confirm_delete'];

    if ($confirm_delete == "on") {
        // Retrieve the profile picture path for deletion
        $sql = "SELECT profile_picture FROM users WHERE id='$user_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $profilePicturePath = $row['profile_picture'];

        // Delete the user record from the database
        $deleteUserSql = "DELETE FROM users WHERE id='$user_id'";
        if ($conn->query($deleteUserSql) === TRUE) {
            // Delete the profile picture file
            if ($profilePicturePath && file_exists($profilePicturePath)) {
                unlink($profilePicturePath);
            }

            // Clear session and redirect to login page
            session_unset();
            session_destroy();
            header("Location: login.php");
            exit();
        } else {
            echo "Error deleting user: " . $conn->error;
        }
    } else {
        // If the user doesn't confirm, redirect back to the profile page
        header("Location: profile.php");
        exit();
    }
}

$conn->close();
?>
