<?php
session_start();
include('config.php');
require './partials/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="container">
    <?php if (isset($error)) echo "<div class='alert alert-danger my-3'>$error</div>"; ?>

    <div class="d-flex align-items-center justify-content-center py-4">
        <div class="text-center">
            <h1 class="fs-1 mb-3">WELCOME "<?php echo $row['name']; ?>!"</h1>
            <h3 class="fs-5">Profile Page</h3>
        </div>
    </div>

    <div class="row align-items-start justify-content-center pb-4">
        <h3 class="mb-3">Edit Profile</h3>
        <div class="col-3">
            <div class="img-thumbnail">
                <img class="img-fluid" src="<?php echo $row['profile_picture']; ?>" alt="Profile Picture" />
            </div>
            <div class="basic-details">
                <p class="my-3">
                    <strong>Name:</strong>
                    <span><?php echo $row['name']; ?></span>
                </p>
                <p>
                    <strong>Email:</strong>
                    <span><?php echo $row['email']; ?></span>
                </p>
            </div>
        </div>

        <div class="col-9">
            <form class="border border-dashed bg-light rounded p-4" method="post" action="edit_profile.php"
                enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" id="name" name="name" type="text" value="<?php echo $row['name']; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input class="form-control" id="new_password" name="new_password" type="password"
                        placeholder="Enter your new password">
                </div>

                <div class="mb-3">
                    <label for="confirm_new_password" class="form-label">Confirm New Password</label>
                    <input class="form-control" id="confirm_new_password" name="confirm_new_password" type="password"
                        placeholder="ReEnter your new password">
                </div>

                <div class="mb-3">
                    <label for="new_profile_picture" class="form-label">New Profile Picture</label>
                    <input class="form-control" id="new_profile_picture" name="new_profile_picture" type="file"
                        accept="image/*">
                </div>

                <button class="btn btn-primary w-100" type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <div class="border border-dotted bg-light rounded p-4 mb-5">
        <h3 class="mb-3">Delete Profile</h3>
        <form method="post" action="delete_profile.php">
            <div class="form-check mb-3">
                <input id="confirmDelete" class="form-check-input" type="checkbox" name="confirm_delete" required>
                <label class="form-check-label" for="confirmDelete">
                    I confirm that I want to delete my profile.
                </label>
            </div>
            <button class="btn btn-danger" type="submit">Delete Profile</button>
            <a class="ms-3" href="logout.php">Logout</a>
        </form>

    </div>
</div>


<?php require './partials/footer.php'; ?>