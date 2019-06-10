<?php

class Input
{
   public static function sanitaize($dirty)
   {
      return htmlentities($dirty, ENT_QUOTES, "UTF-8");
   }

   public static function get($input)
   {
      if (isset($_POST[$input])) {
         return self::sanitaize($_POST($input));
      } else if (isset($_GET[$input])) {
         return self::sanitaize($_GET[$input]);
      }
   }
}
