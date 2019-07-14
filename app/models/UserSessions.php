<?php

namespace App\Models;

use Core\Cookie;
use Core\Model;
use Core\Session;

class UserSessions extends Model
{
   public $id;
   public $user_id;
   public $session;
   public $user_agent;

   public function __construct()
   {
      $table = 'user_sessions';
      parent::__construct($table);
   }

   public static function getFromCookie()
   {
      $userSessoin = new self();
      if (Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
         $userSessoin = $userSessoin->findFirst([
            'conditions' => 'user_agent = ? AND session = ?',
            'bind' => [Session::uagent_no_version(), Cookie::get(REMEMBER_ME_COOKIE_NAME)]
         ]);
      }
      if (!$userSessoin) return false;
      return $userSessoin;
   }
}
