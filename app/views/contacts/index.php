<?php $this->start('body'); ?>
<h2 class="text-center">My Contacts</h2>
<table class="table table-stripe table-condense table-bordered table-hover">
   <thead>
      <th>Name</th>
      <th>Email</th>
      <th>Cell Phone</th>
      <th>Home Phone</th>
      <th>Work Phone</th>
      <th></th>
   </thead>
   <tbody>
      <?php foreach ($this->contacts as $contact) : ?>
         <tr>
            <td><a href="<?= PROOT ?>contacts/details/<?= $contact->id; ?>"><?= $contact->displayName(); ?></a></td>
            <td><?= $contact->email; ?></td>
            <td><?= $contact->cell_phone; ?></td>
            <td><?= $contact->home_phone; ?></td>
            <td><?= $contact->work_phone; ?></td>
            <td>
               <a href="<?= PROOT ?>contacts/edit/<?= $contact->id ?>" class="btn btn-info btn-sm">
                  <i class="far fa-edit"></i> Edit
               </a>
               <a href="<?= PROOT ?>contacts/delete/<?= $contact->id ?>" class="btn btn-danger btn-sm" onclick="if(!confirm('Are you sure?')) return false;">
                  <i class="fas fa-times"></i> Delete
               </a>
            </td>
         </tr>
      <?php endforeach; ?>
   </tbody>
</table>
<?php $this->end(); ?>