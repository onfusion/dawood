<?php
session_start();
include('config.php');
require './partials/header.php';

// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit();
// }
?>

<div class="container">
    <div class="d-flex align-items-center justify-content-center py-4">
        <div class="text-center">
        <h1 class="fs-1 mb-3">WECOME</h1>
        <h3 class="fs-5">Home Page</h3>
        </div>
    </div>
</div>

<?php require './partials/footer.php'; ?>