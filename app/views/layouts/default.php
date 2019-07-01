<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title><?= $this->siteTitle(); ?></title>
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
   <link rel="stylesheet" href="<?= PROOT ?>css/bootstrap.min.css">
   <link rel="stylesheet" href="<?= PROOT ?>css/custom.css">
   <script src="<?= PROOT ?>js/jquery-3.4.1.slim.min.js"></script>
   <script src="<?= PROOT ?>js/bootstrap.min.js"></script>

   <?= $this->content('head'); ?>
</head>

<body>
   <?php include 'main_menu.php'; ?>
   <div class="container-fluid" style="min-height:calc(100% - 125px)">
      <?= $this->content('body'); ?>
   </div>
</body>

</html>