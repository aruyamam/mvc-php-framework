<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <title><?=$this->siteTitle();?></title>
      <link rel="stylesheet" href="<?=PROOT?>css/bootstrap.min.css">
      <link rel="stylesheet" href="<?=PROOT?>css/custom.css">
      <script src="<?=PROOT?>js/jquery-3.4.1.slim.min.js"></script>
      <script src="<?=PROOT?>js/bootstrap.min.js"></script>

      <?= $this->content('head'); ?>
   </head>
   <body>
      <?= $this->content('body'); ?>
   </body>
</html>