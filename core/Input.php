<?php

class Input
{
   public function isPost(): bool
   {
      return $this->getRequestMethod() === 'POST';
   }

   public function isPut(): bool
   {
      return $this->getRequestMethod() === 'PUT';
   }

   public function isGet(): bool
   {
      return $this->getRequestMethod() === 'GET';
   }

   public function getRequestMethod(): string
   {
      return strtoupper($_SERVER['REQUEST_METHOD']);
   }

   public function get($input = false)
   {
      if (!$input) {
         // return entire request array and sanitize it
         $data = [];
         foreach ($_REQUEST as $field => $value) {
            $data[$field] = FH::sanitize($value);
         }
         return $data;
      }
      return FH::sanitize($_REQUEST[$input]);
   }

   public function csrfCheck()
   {
      if (!FH::checkToken($this->get('csrf_token'))) Router::redirect('restricted/badToken');
      return true;
   }
}
