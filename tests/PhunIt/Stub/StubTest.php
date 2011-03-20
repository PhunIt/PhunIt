<?php

class Stub {

  protected $methods;

  public function stubs($method) {
    $this->methods[$method] = new Method();
    return $this->methods[$method];
  }

  public function __call($method, $args) {
    return $this->methods[$method]->call();
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

}