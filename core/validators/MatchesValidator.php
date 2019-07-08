<?php

class MatchesValidator extends CustomValidator
{
   public function runValidation(): bool
   {
      $value = $this->_model->{$this->field};
      return $pass = $value === $this->rule;
   }
}
