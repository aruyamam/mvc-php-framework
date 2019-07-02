<?php $this->setSiteTitle('Edit Contact'); ?>
<?php $this->start('body'); ?>
<div class="col-md-8 offset-md-2 card card-body bg-light">
   <h2 class="text-center card-title">Edit <?= $this->contact->displayName(); ?></h2>
   <?php $this->partial('contacts', 'form'); ?>
</div>
</div>
<?php $this->end(); ?>