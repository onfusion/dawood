<?php
include('config.php');
require './partials/header.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Handle profile picture upload
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["profile_picture"]["name"]);
    move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile);

    $sql = "INSERT INTO users (name, email, password, profile_picture) VALUES ('$name', '$email', '$password', '$targetFile')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<div class="container">
    <?php if (isset($error)) echo "<div class='alert alert-danger my-3'>$error</div>"; ?>

    <div class="d-flex align-items-center justify-content-center py-4">
        <div class="text-center">
            <h1 class="fs-1 mb-3">WELCOME</h1>
            <h3 class="fs-5">Signup Page</h3>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-center py-4">
        <form class="border border-dashed bg-light rounded p-4 w-50 mb-5" method="post" action=""
            enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" id="name" name="name" type="name" placeholder="Enter your name" required>
            </div>

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

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input class="form-control" id="confirm_password" name="confirm_password" type="password"
                    placeholder="ReEnter your password" required>
            </div>

            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input class="form-control" id="profile_picture" name="profile_picture" type="file" accept="image/*"
                    required>
            </div>

            <button class="btn btn-primary w-100" type="submit">Sign Up</button>
        </form>
    </div>
</div>

<?php require './partials/footer.php'; ?>