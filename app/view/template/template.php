<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Claromentis</title>
    <link href="app/view/css/bootstrap.min.css?v=<?php echo date('Hmi');?>" rel="stylesheet">
    <link href="app/view/css/bootstrap-utilities.min.css?v=<?php echo date('Hmi');?>" rel="stylesheet">
    <link href="app/view/css/bootstrap-grid.min.css?v=<?php echo date('Hmi');?>" rel="stylesheet">
    <script src="app/view/js/sweetalert2.all.min.js?v=<?php echo date('Hmi');?>"></script>
    <link href="app/view/css/sweetalert2.min.css?v=<?php echo date('Hmi');?>" rel="stylesheet">
    <link rel="stylesheet" href="app/view/css/claromentis.css?v=<?php echo date('Hmi');?>">
  </head>
  <body>
    <div class="container">

    <?php
      View::render($data);
    ?>
  </body>
</html>