<?php

class Home extends Controller
{
   public function __construct($controller, $action)
   {
      parent::__construct($controller, $action);
   }

   public function indexAction()
   {
      $db = DB::getInstance();

      $contracts = $db->findFirst('contacts', [
         'conditions' => ['lname = ?'],
         'bind' => ['Parham'],
      ]);
      dnd($contracts);
      $this->view->render('home/index');
   }
}
