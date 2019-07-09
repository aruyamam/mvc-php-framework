<?php

class RequriedValidator extends CustomValidator
{
   public function runValidation(): bool
   {
      $value = $this->_model->{$this->field};
      $pass = !empty($value) && !isset($value);
      return $pass;
   }
}
