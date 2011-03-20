<?php

class Stub {

  protected $methodContainer;

  public function __construct() {
    $this->methodContainer = new MethodContainer();
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

class Method {

  protected $value;

  public function returns($value) {
    $this->value = $value;
  }

  public function call() {
    return $this->value;
  }

}

class MethodContainer {

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

class StubTest extends \PHPUnit_Framework_TestCase {

  public function testNeedsAMethodNameToStub() {
    $this->setExpectedException('\Exception');
    $stub = new Stub();
    $stub->stubs();
  }

  public function testShouldReturnAMethodWhenStubbing() {
    $stub = new Stub();
    $this->assertTrue($stub->stubs("chuchu") instanceof Method);
  }

  public function testShouldReturnAConfiguredValue() {
    $stub = new Stub();
    $stub->stubs("chuchu")->returns("blabla");
    $this->assertEquals("blabla", $stub->chuchu());
  }

  public function testShouldBeAbleToStubMoreMethods() {
    $stub = new Stub();
    $stub->stubs("chuchu")->returns("blabla");
    $stub->stubs("arbol")->returns("cocotero");
    $this->assertEquals("cocotero", $stub->arbol());
  }

  public function testShouldThrowExceptionIfMethodIsNotStubbed() {
    $this->setExpectedException("\Exception");
    $stub = new Stub();
    $stub->chuchu();
  }

}