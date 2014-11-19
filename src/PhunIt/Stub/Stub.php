<?php

namespace PhunIt\Stub;

use PhunIt\Stub\Stubbed;
use PhunIt\Method\Container;

class Stub implements Stubbed {

  protected $methodContainer;

  public function __construct() {
    $this->methodContainer = new Container();
  }

  public function stubs($method) {
    return $this->methodContainer->add($method);
  }

  public function __call($method, $args) {
    if (!$this->methodContainer->has($method)) {
      throw new \Exception("Method {$method} is not stubbed");
    }
    return $this->methodContainer->get($method)->call();
  }

}