<?php

namespace PhunIt\Method;

use PhunIt\Method\Method;

class Container {

  protected $methods = array();

  public function add($method) {
    $this->methods[$method] = new Method();
    return $this->methods[$method];
  }

  public function has($method) {
    return array_key_exists($method, $this->methods);
  }

  public function get($method) {
    return $this->methods[$method];
  }

}