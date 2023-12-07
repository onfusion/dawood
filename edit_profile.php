<?php
session_start();
include('config.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Handle new profile picture upload
    $new_targetDirectory = "uploads/";
    $new_targetFile = $new_targetDirectory . basename($_FILES["new_profile_picture"]["name"]);
    move_uploaded_file($_FILES["new_profile_picture"]["tmp_name"], $new_targetFile);

    // Update user data in the database
    $update_sql = "UPDATE users SET name='$name'";

    // Update password if a new one is provided
    if ($new_password != '') {
        if ($new_password == $confirm_new_password) {
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $update_sql .= ", password='$hashed_password'";
        } else {
            echo "New passwords do not match.";
            exit();
        }
    }

    // Update profile picture path
    if ($_FILES["new_profile_picture"]["name"] != '') {
        $update_sql .= ", profile_picture='$new_targetFile'";
    }

    $update_sql .= " WHERE id='$user_id'";
    $conn->query($update_sql);

    header("Location: profile.php");
    exit();
}

$conn->close();
?>
