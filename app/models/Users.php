<?php

namespace App\Models;

use App\Models\UserSessions;
use Core\Cookie;
use Core\Model;
use Core\Session;
use Core\Validators\EmailValidator;
use Core\Validators\MaxValidator;
use Core\Validators\MatchesValidator;
use Core\Validators\MinValidator;
use Core\Validators\RequriedValidator;
use Core\Validators\UniqueValidator;

class Users extends Model
{
   private $_isLoggedIn;
   private $_sessoinName;
   private $_cookieName;
   private $_confirm;
   public static $currentLoggedInUser = null;
   public $id;
   public $username;
   public $email;
   public $password;
   public $fname;
   public $lname;
   public $acl;

   public function __construct($user = '')
   {
      $table = 'users';
      parent::__construct($table);
      $this->_sessoinName = CURRENT_USER_SESSION_NAME;
      $this->_cookieName = REMEMBER_ME_COOKIE_NAME;
      $this->_softDelete = true;
      if ($user !== '') {
         if (is_int($user)) {
            $u = $this->_db->findFirst('users', [
               'conditions' => 'id = ?',
               'bind' => [$user]
            ], 'App\Models\Users');
         } else {
            $u = $this->_db->findFirst('users', [
               'conditions' => 'username = ?',
               'bind' => [$user]
            ], 'App\Models\Users');
         }
         if ($u) {
            foreach ($u as $key => $val) {
               $this->$key = $val;
            }
         }
      }
   }

   public function validator()
   {
      if ($this->isNew()) {
         $this->runValidation(new RequriedValidator($this, [
            'field' => 'fname',
            'msg' => 'First Name is required.'
         ]));

         $this->runValidation(new RequriedValidator($this, [
            'field' => 'lname',
            'msg' => 'Last Name is required.'
         ]));

         $this->runValidation(new RequriedValidator($this, [
            'field' => 'email',
            'msg' => 'Eamil is required.'
         ]));
         $this->runValidation(new EmailValidator($this, [
            'field' => 'email',
            'msg' => 'You must provide a valid email address'
         ]));
         $this->runValidation(new MaxValidator($this, [
            'field' => 'email',
            'rule' => 150,
            'msg' => 'Email must be less than 150 characters.'
         ]));
         $this->runValidation(new UniqueValidator($this, [
            'field' => 'email',
            'msg' => 'Email already exists. Please choose a new one.'
         ]));

         $this->runValidation(new RequriedValidator($this, [
            'field' => 'username',
            'msg' => 'Username is required.'
         ]));
         $this->runValidation(new MinValidator($this, [
            'field' => 'username',
            'rule' => 6,
            'msg' => 'Username must be at least 6 characters.'
         ]));
         $this->runValidation(new MaxValidator($this, [
            'field' => 'username',
            'rule' => 150,
            'msg' => 'Username must be less than 150 characters.'
         ]));
         $this->runValidation(new UniqueValidator($this, [
            'field' => 'username',
            'msg' => 'Username already exists. Please choose a new one.'
         ]));

         $this->runValidation(new RequriedValidator($this, [
            'field' => 'password',
            'msg' => 'Password is required.'
         ]));
         $this->runValidation(new MinValidator($this, [
            'field' => 'password',
            'rule' => 6,
            'msg' => 'Password must be a minimum of 6 characters.'
         ]));
         $this->runValidation(new MatchesValidator($this, [
            'field' => 'password',
            'rule' => $this->_confirm,
            'msg' => 'Your password do not match'
         ]));
      }
   }

   public function beforeSave()
   {
      if ($this->isNew()) {
         $this->password = password_hash($this->password, PASSWORD_DEFAULT);
      }
   }

   public function findByUsername($username)
   {
      return $this->findFirst([
         'conditions' => 'username = ?',
         'bind' => [$username]
      ]);
   }

   public static function currentUser()
   {
      if (self::$currentLoggedInUser === null && Session::exists(CURRENT_USER_SESSION_NAME)) {
         $u = new self((int) Session::get(CURRENT_USER_SESSION_NAME));
         self::$currentLoggedInUser = $u;
      }

      return self::$currentLoggedInUser;
   }

   public function login($rememberMe = false)
   {
      Session::set($this->_sessoinName, $this->id);
      if ($rememberMe) {
         $hash = md5(uniqid() . rand(0, 100));
         $user_agent = Session::uagent_no_version();
         Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
         $fields = [
            'session' => $hash,
            'user_agent' => $user_agent,
            'user_id' => $this->id
         ];
         $this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);
         $this->_db->insert('user_sessions', $fields);
      }
   }

   public static function loginUserFromCookie()
   {
      $userSession = UserSessions::getFromCookie();
      if ($userSession && $userSession->user_id != '') {
         $user = new self((int) $userSession->user_id);
         if ($user) {
            $user->login();
         }
         return $user;
      }
      return;
   }

   public function logout()
   {
      $userSession = UserSessions::getFromCookie();
      if ($userSession) $userSession->delete();
      Session::delete(CURRENT_USER_SESSION_NAME);
      if (Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
         Cookie::delete(REMEMBER_ME_COOKIE_NAME);
      }
      self::$currentLoggedInUser = null;
      return true;
   }

   public function acls()
   {
      if (empty($this->acl)) return [];
      return json_decode($this->acl, true);
   }

   public function setConfirm($value)
   {
      $this->_confirm = $value;
   }

   public function getConfirm()
   {
      return $this->_confirm;
   }
}
