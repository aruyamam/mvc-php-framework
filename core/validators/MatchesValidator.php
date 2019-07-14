<?php

namespace Core\Validators;

use Core\Validators\CustomValidator;

class MatchesValidator extends CustomValidator
{
   public function runValidation(): bool
   {
      $value = $this->_model->{$this->field};
      $pass = $value === $this->rule;
      return $pass;
   }
}
