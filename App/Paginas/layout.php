<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo3.png">
    <title>Dragon | Teste</title>

    <? require 'include/css.php'; ?>

    <?= $v->section("css"); ?>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <? require 'include/preload.php'; ?>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <? require 'include/header.php'; ?>
        <? require 'include/menu.php'; ?>

        <div class="page-wrapper">
            <?= $v->section("content"); ?>
        </div>
    </div>

    <? require 'include/javascript.php'; ?>

    <?php echo $v->section("script"); ?>

</body>

</html>