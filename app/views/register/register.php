<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="col-md-6 offset-md-3 card card-body bg-light">
   <h3 class="text-center">Register Here!</h3>
   <form action="" class="form" method="post">
      <div><?= $this->displayErrors; ?></div>
      <div class="form-group">
         <label for="fname">First Name</label>
         <input type="text" name="fname" id="fname" class="form-control" value="<?= $this->post['fname']; ?>">
      </div>
      <div class="form-group">
         <label for="lname">Last Name</label>
         <input type="text" name="lname" id="lname" class="form-control" value="<?= $this->post['lname']; ?>">
      </div>
      <div class="form-group">
         <label for="email">Email</label>
         <input type="email" name="email" id="email" class="form-control" value="<?= $this->post['email']; ?>">
      </div>
      <div class="form-group">
         <label for="username">Choose a Useraname</label>
         <input type="text" name="username" id="username" class="form-control" value="<?= $this->post['username']; ?>">
      </div>
      <div class="form-group">
         <label for="password">Choose a Password</label>
         <input type="password" name="password" id="password" class="form-control" value="<?= $this->post['password']; ?>">
      </div>
      <div class="form-group">
         <label for="confirm">Confirm Password</label>
         <input type="password" name="confirm" id="confirm" class="form-control" value="<?= $this->post['confirm']; ?>">
      </div>
      <div class="float-right">
         <input type="submit" class="btn btn-primary btn-lg" value="Register">
      </div>
   </form>
</div>
<?php $this->end(); ?>