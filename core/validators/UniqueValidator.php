<?php

class UniqueValidator extends CustomValidator
{
   public function runValidation(): bool
   {
      $field = (is_array($this->field)) ? $this->field[0] : $this->field;
      $value = $this->_model->{$field};

      $conditions = ["{$field} = ?"];
      $bind = [$value];

      // check updating record
      if (!empty($this->_model->id)) {
         $conditions[] = "id = ?";
         $bind[] = $this->_model->id;
      }

      // this allow you to check multiple fields for unique
      if (is_array($this->field)) {
         array_shift($this->field);
         foreach ($this->field as $adds) {
            $conditions[] = "{$adds} = ?";
            $bind[] = $this->_model->{$adds};
         }
      }
      $queryParams = [
         'conditions' => $conditions,
         'bind' => $bind
      ];
      $other = $this->_model->findFirst($queryParams);
      return (!$other);
   }
}
