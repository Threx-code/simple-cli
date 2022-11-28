<?php
use App\Validation\Csrf as CSRF;

$crfToken  = CSRF::crfToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Oluwatosin Amokeodo">
<meta name="description" content="Assignment">
<meta name="csrf-token" content="<?php echo $crfToken ?>">

<!--===================FAVICON PATH ================================-->
<link rel="icon" href="">
<!--================================================================-->

<!--=================== APP TITLE ==================================-->
<title>Assignment</title>
<!--================================================================-->

<!--================== CSS PATHS ===================================-->
<link rel="stylesheet" href="System/assets/styles/bootstrap.min.css">
<link rel="stylesheet" href="System/assets/styles/style.css">
    <link rel="stylesheet" href="System/assets/styles/jquery-ui.min.css">
<!--================== CSS PATHS ===================================-->

<!--====================== JAVASCRIPT PATH==========================-->
<Script type="text/javascript" src="System/assets/scripts/jquery-3.3.1.min.js"></script>
    <Script type="text/javascript" src="System/assets/scripts/jquery-ui.min.js"></script>
<!--================================================================-->
</head>
<body>
