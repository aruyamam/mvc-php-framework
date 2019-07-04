<?php

class FH
{
   public static function inputBlock($type, $label, $name, $value = '', $inputAttrs = [], $divAttrs = [])
   {
      $divString = slef::stringifyAttrs($divAttrs);
      $inputString = slef::stringifyAttrs($inputAttrs);
      $html = '<div' . $divString . '>';
      $html .= '<label for="' . $name . '">' . $label . '</label>';
      $html .= '<input type="' . $type . '" id="' . $name . '" name="' . $name . '" value="' . $value . '"' . $inputString . '>';
      $html .= '</div>';
      return $html;
   }

   public static function submitTag($buttonText, $inputAttrs = [])
   {
      $inputString = slef::stringifyAttrs($inputAttrs);
      $html = '<input type="submit" value="' . $buttonText . '"' . $inputString . '>';
      return $html;
   }

   public static function submitBlock($buttonText, $inputAttrs = [], $divAttrs = [])
   {
      $divString = slef::stringifyAttrs($divAttrs);
      $inputString = slef::stringifyAttrs($inputAttrs);
      $html = '<div' . $divString . ' >';
      $html .= '<input type="submit" value="' . $buttonText . '"' . $inputString . '>';
      $html .= '</div>';
      return $html;
   }

   public static function stringifyAttrs($attrs)
   {
      $string = ' ';
      foreach ($attrs as $key => $val) {
         $string .= ' ' . $key .  ' ="' . $val . '"';
      }
      return $string;
   }

   public static function generateToken()
   {
      $token = base64_encode(openssl_random_pseudo_bytes(32));
      Session::set('csrf_token', $token);
      return $token;
   }

   public static function checkToken($token)
   {
      return (Session::exists('csrf_token') && Session::get('csrf_token') === $token);
   }

   public static function csrfInput()
   {
      return '<input type="hidden" name="csrf_token" id="csrf_token" value="' . self::generateToken() . '">';
   }
}