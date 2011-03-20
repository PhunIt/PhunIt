<?php

class StubFactory {

  public static function create($class) {

  }

}

class StubFactoryTest extends PHPUnit_Framework_TestCase {

  public function testNeedsAClassNameToCreateAStub() {
    $this->setExpectedException('\Exception');
    $stub = StubFactory::create();
  }

  public function testShouldReturnAStubbedInstaceOfTheClass() {
    $stub = StubFactory::create('ChuChu');
    $this->assertTrue($stub instanceof ChuChu);
  }

}