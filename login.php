<?php
session_start();
include('config.php');
require './partials/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: profile.php");
            exit();
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "User not found. Please sign up.";
    }
}

$conn->close();
?>

<div class="container">
    <?php if (isset($error)) echo "<div class='alert alert-danger my-3'>$error</div>"; ?>

    <div class="d-flex align-items-center justify-content-center py-4">
        <div class="text-center">
            <h1 class="fs-1 mb-3">WELCOME</h1>
            <h3 class="fs-5">Login Page</h3>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-center py-4">
        <form class="border border-dashed bg-light rounded p-4 w-50" method="post" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" id="email" name="email" type="email" placeholder="Enter your email"
                    required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input class="form-control" id="password" name="password" type="password"
                    placeholder="Enter your password" required>
            </div>

            <button class="btn btn-primary w-100" type="submit">Login</button>
            <p class="mt-3">Not registered? Click here for <a href="signup.php">Sign up here</a>.</p>
        </form>
    </div>
</div>

<?php require './partials/footer.php'; ?>