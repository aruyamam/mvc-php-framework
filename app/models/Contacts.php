<?php

namespace App\Models;

use Core\Model;
use Core\Validators\MaxValidator;
use Core\Validators\RequriedValidator;

class Contacts extends Model
{
   public $id;
   public $user_id;
   public $fname;
   public $lname;
   public $email;
   public $address;
   public $address2;
   public $city;
   public $state;
   public $zip;
   public $home_phone;
   public $cell_phone;
   public $work_phone;

   public function __construct()
   {
      $table = 'contacts';
      parent::__construct($table);
      $this->_softDelete = true;
   }

   public function validator()
   {
      $this->runValidation(new RequriedValidator($this, [
         'field' => 'fname',
         'msg' => 'First Name is required.',
      ]));
      $this->runValidation(new MaxValidator($this, [
         'field' => 'fname',
         'msg' => 'First Name must be less than 156 characters.',
         'rule' => 155
      ]));
      $this->runValidation(new RequriedValidator($this, [
         'field' => 'lname',
         'msg' => 'Last Name is required.',
      ]));
      $this->runValidation(new MaxValidator($this, [
         'field' => 'lname',
         'msg' => 'Last Name must be less than 156 characters.',
         'rule' => 155
      ]));
   }

   public function findAllByUserId($user_id, $params = [])
   {
      $conditions = [
         'conditions' => 'user_id = ?',
         'bind' => [$user_id]
      ];
      $conditions = array_merge(
         $conditions,
         $params
      );
      return $this->find($conditions);
   }

   public function displayName()
   {
      return $this->fname . ' ' . $this->lname;
   }

   public function findByIdAndUserId($contact_id, $user_id, $params = [])
   {
      $conditions = [
         'conditions' => 'id = ? AND user_id = ?',
         'bind' => [$contact_id, $user_id]
      ];
      $conditions = array_merge($conditions, $params);
      return $this->findFirst($conditions);
   }

   public function displayAddress()
   {
      $address = '';
      if (!empty($this->address)) {
         $address .= $this->address . '<br>';
      }
      if (!empty($this->address2)) {
         $address .= $this->address2 . '<br>';
      }
      if (!empty($this->city)) {
         $address .= $this->city . ', ';
      }
      $address .= $this->state . ' ' . $this->zip . '<br>';
      return $address;
   }

   public function displayAddressLabel()
   {
      $html = $this->displayName() . '<br>';
      $html .= $this->displayAddress();
      return $html;
   }
}
