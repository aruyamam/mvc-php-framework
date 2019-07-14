<?php

namespace Core\Validators;

use Core\Validators\CustomValidator;

class MaxValidator extends CustomValidator
{
   public function runValidation(): bool
   {
      $value = $this->_model->{$this->field};
      $pass = (strlen($value) <= $this->rule);
      return $pass;
   }
}
