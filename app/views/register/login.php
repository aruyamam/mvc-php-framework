<?php

use Core\FH;
?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="col-md-6 offset-md-3 card card-body bg-light">
   <h3 class="text-center card-title">Log In</h3>
   <form action="<?= PROOT ?>register/login" class="form" method="post">
      <?= FH::csrfInput(); ?>
      <div><?= FH::displayErrors($this->displayErrors); ?></div>
      <?= FH::inputBlock('text', 'Username', 'username', $this->login->username, ['class' => 'form-control'], ['class' => 'form-group']) ?>
      <?= FH::inputBlock('password', 'Password', 'password', $this->login->password, ['class' => 'form-control'], ['class' => 'form-group']) ?>
      <?= FH::checkboxBlock('Remember Me', 'remember_me', $this->login->getRememberMeChecked(), [], ['class' => 'form-group']) ?>
      <?= FH::submitBlock('Login', ['class' => 'btn btn-primary btn-large'], ['class' => 'form-group']) ?>
      <div class="text-right">
         <a href="<?= PROOT ?>register/register" class="text-primary">Register</a>
      </div>
   </form>
</div>
<?php $this->end(); ?>