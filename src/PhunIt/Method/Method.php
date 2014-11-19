<?php

namespace PhunIt\Method;

class Method {

  protected $value;

  public function returns($value) {
    $this->value = $value;
  }

  public function call() {
    return $this->value;
  }

}