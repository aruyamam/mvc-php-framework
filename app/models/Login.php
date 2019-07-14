<?php

namespace App\Models;

use Core\Model;
use Core\Validators\RequriedValidator;

class Login extends Model
{
   public $username;
   public $password;
   public $remember_me;

   public function __construct()
   {
      parent::__construct('tmp_fake');
   }

   public function validator()
   {
      $this->runValidation(new RequriedValidator($this, [
         'field' => 'username',
         'msg' => 'Username is required.'
      ]));
      $this->runValidation(new RequriedValidator($this, [
         'field' => 'password',
         'msg' => 'Password is required.'
      ]));
   }

   public function getRememberMeChecked()
   {
      return $this->remember_me === 'on';
   }
}
