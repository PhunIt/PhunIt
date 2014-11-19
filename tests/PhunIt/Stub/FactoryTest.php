<?php

use PhunIt\Stub\Factory;
use PhunIt\Stub\Stubbed;

class FactoryTest extends PHPUnit_Framework_TestCase {

  public function testNeedsAClassNameToCreateAStub() {
    $this->setExpectedException('\Exception');
    $stub = Factory::create();
  }

  public function testShouldReturnAnInstaceOfTheReceivedClass() {
    $stub = Factory::create('ChuChu');
    $this->assertTrue($stub instanceof ChuChu);
  }

  public function testShouldThrowExceptionIfClassAlreadyExists() {
    $this->setExpectedException('\Exception');
    Factory::create('ArrayObject');
  }

  public function testShouldReturnAnInstanceIfClassAlreadyCreated() {
    $stub = Factory::create('ChuChu');
    $AnotherStub = Factory::create('ChuChu');
    $this->assertTrue($AnotherStub instanceof ChuChu);
  }

  public function testReturnedInstanceShouldAlsoBeAStub() {
    $stub = Factory::create('ChuChu');
    $this->assertTrue($stub instanceof Stubbed);
  }

}