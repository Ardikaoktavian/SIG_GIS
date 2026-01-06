<?php
include "helper.php";   // Materi GIS Pertemuan 13
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}

$pageFile = 'pages/' . $page . '.php';
?>

<!DOCTYPE html>
<html lang="en">
<!-- Materi GIS Pertemuan 12 -->
<!-- Link Materi https://drive.google.com/drive/folders/1Teo0uMVYgK_eE3VcXJvr8NpG5rGVJo5R -->
<?php include('layouts/head.php'); ?>

<?php include("layouts/sidenav.php"); ?>
<div class="main">
    <?php include($pageFile); ?>
</div>

<?php
if (isset($scriptFile)) {
    include 'scripts/' . $scriptFile . '.php';
}
?>

</body>

</html>