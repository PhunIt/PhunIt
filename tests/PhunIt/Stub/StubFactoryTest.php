<?php

class StubFactory {

  public static function create($class) {
    eval("class {$class} {
      }");
    return new $class();
  }

}

class StubFactoryTest extends PHPUnit_Framework_TestCase {

  public function testNeedsAClassNameToCreateAStub() {
    $this->setExpectedException('\Exception');
    $stub = StubFactory::create();
  }

  public function testShouldReturnAnInstaceOfTheReceivedClass() {
    $stub = StubFactory::create('ChuChu');
    $this->assertTrue($stub instanceof ChuChu);
  }

  public function testShouldThrowExceptionIfClassAlreadyExists() {
    $this->setExpectedException('\Exception');
    StubFactory::create('ArrayObject');
  }

}