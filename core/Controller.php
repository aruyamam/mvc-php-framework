<?php

namespace Core;

use Core\Application;

class Controller extends Application
{
   protected $_controller;
   protected $_action;
   public $view;
   public $request;

   public function __construct($contoller, $action)
   {
      parent::__construct();
      $this->_controller = $contoller;
      $this->_action = $action;
      $this->request = new Input();
      $this->view = new View();
   }

   protected function load_model($model)
   {
      $modelPath = 'App\Models\\' . $model;
      if (class_exists($modelPath)) {
         $this->{$model . 'Model'} = new $modelPath();
      }
   }
}
