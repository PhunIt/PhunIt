<?php

class Stub {
  protected $method;

  public function stubs($method) {
    $this->method = new Method();
    return $this->method;
  }

  public function chuchu() {
    return $this->method->returns();
  }

}

class Method {
  public function returns() {
    return "blabla";
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