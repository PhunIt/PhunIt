<?php

class Stub {
  public function stubs($method) {
    
  }
}

class StubTest extends \PHPUnit_Framework_TestCase {
  public function testNeedsAMethodNameToStub() {
    $this->setExpectedException('\Exception');
    $stub = new Stub();
    $stub->stubs();
  }
}