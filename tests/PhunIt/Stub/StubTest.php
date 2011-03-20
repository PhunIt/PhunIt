<?php

class Stub {

  public function stubs($method) {
    return new Method();
  }

  public function chuchu() {
    return "blabla";
  }

}

class Method {
  public function returns() {
    
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
    $this->assertTrue($stub->stubs('chuchu') instanceof Method);
  }

  public function testShouldReturnAConfiguredValue() {
    $stub = new Stub();
    $stub->stubs('chuchu')->returns("blabla");
    $this->assertEquals("blabla", $stub->chuchu());
  }

}