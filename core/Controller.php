<?php

class Controller extends Application
{
   protected $_controller;
   protected $_action;

   public $view;

   public function __construct($contoller, $action)
   {
      parent::__construct();
      $this->_controller = $contoller;
      $this->_action = $action;
      $this->view = new View();
   }
}