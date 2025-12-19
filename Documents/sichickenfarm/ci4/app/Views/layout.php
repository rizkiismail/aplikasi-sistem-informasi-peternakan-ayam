<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title> <?= $title; ?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('bootstrap4/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('bootstrap4/plugin/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <style>
        body {
            padding-top: 5rem;
        }

        .starter-template {
            padding: 3rem 1.5rem;
            text-align: center;
        }
    </style>
</head>

<body>

    <?= $this->include('navbar')  ?>

    <main role="main" class="container">



    </main>
    <!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?= base_url('bootstrap4/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('bootstrap4/js/jquery-3.5.1.min.js') ?>"></script>
    <script src="<?= base_url('bootstrap4/js/custom.js') ?>" rel="stylesheet" type="text/javascript"></script>
    <script src="<?= base_url('bootstrap4/plugin/js/bootstrap-datepicker.min.js') ?>" type="text/javascript"></script>

</body>

</html>