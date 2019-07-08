<?php

class MinValidator extends CustomValidator
{
   public function runValidation(): bool
   {
      $value = $this->_model->{$this->field};
      $pass = (strlen($value) >= $this->rule);
      return $pass;
   }
}
