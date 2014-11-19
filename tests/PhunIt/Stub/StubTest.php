<?php

use PhunIt\Stub\Stub;
use PhunIt\Method\Method;

class StubTest extends \PHPUnit_Framework_TestCase {

  public function setUp() {
    $this->stub = new Stub();
  }

  public function testNeedsAMethodNameToStub() {
    $this->setExpectedException('\Exception');
    $this->stub->stubs();
  }

  public function testShouldReturnAMethodWhenStubbing() {
    $this->assertTrue($this->stub->stubs("chuchu") instanceof Method);
  }

  public function testShouldReturnAConfiguredValue() {
    $this->stub->stubs("chuchu")->returns("blabla");
    $this->assertEquals("blabla", $this->stub->chuchu());
  }

  public function testShouldBeAbleToStubMoreMethods() {
    $this->stub->stubs("chuchu")->returns("blabla");
    $this->stub->stubs("arbol")->returns("cocotero");
    $this->assertEquals("cocotero", $this->stub->arbol());
  }

  public function testShouldThrowExceptionIfMethodIsNotStubbed() {
    $this->setExpectedException("\Exception");
    $this->stub->chuchu();
  }

}