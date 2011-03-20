<?php

class StubFactoryTest extends PHPUnit_Framework_TestCase {
  public function testNeedsAClassNameToCreateAStub() {
    $this->setExpectedException('\Exception');
    $stub = StubFactory::create();
  }
}