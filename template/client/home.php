<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL?>asset/common/plugins/bootstrap/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL?>asset/common/css/style.css" crossorigin="anonymous">
    <title>Home</title>
</head>
<body>

<?php include "header.php";?>
<section>
    <?php echo $content;?>
</section>
<?php include "footer.php";?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo BASE_URL?>asset/common/js/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="<?php echo BASE_URL?>asset/common/plugins/bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="<?php echo BASE_URL?>asset/common/plugins/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
