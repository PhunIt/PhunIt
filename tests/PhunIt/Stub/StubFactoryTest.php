<?php

class StubFactory {

  protected static $stubbedClasses = array();

  public static function create($class) {
    if (class_exists($class) && !in_array($class, self::$stubbedClasses)) {
      throw new Exception("Class {$class} already exists");
    }

    if (!in_array($class, self::$stubbedClasses)) {
      eval("class {$class} {\n}");
      self::$stubbedClasses[] = $class;
    }

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

  public function testShouldReturnAnInstanceIfClassAlreadyCreated() {
    $stub = StubFactory::create('ChuChu');
    $AnotherStub = StubFactory::create('ChuChu');
    $this->assertTrue($AnotherStub instanceof ChuChu);
  }

}