<?php
session_start();
include 'koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="bootstrap-5.3.3/dist/css//bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
</head>

<body>
    <?php include 'layout/navbar.php'; ?>
    <!-- <h2 class="text-center mt-4">Welcome to <?php echo $_SESSION['nama']; ?></h2> -->
    <!-- <a href="controller/logout.php" class="btn btn-danger btn-sm">Log out</a> -->
    <div class="content">
        <?php
        if (isset($_GET['pg'])) {
            if (file_exists('content/' . $_GET['pg'] . '.php')) {
                include 'content/' . $_GET['pg'] . '.php';
            }
        } else {
            include 'content/dashboard.php';
        }
        ?>

    </div>



    <?php include 'layout/footer.php'; ?>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script> -->

    <script src="bootstrap-5.3.3/dist/js/bootstrap.bundle.js"></script>
</body>

</html>