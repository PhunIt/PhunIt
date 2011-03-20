<?php

namespace PhunIt\Stub;

class Factory {

  protected static $stubbedClasses = array();

  public static function create($class) {
    self::validateClass($class);

    self::createClassIfNeeded($class);

    return new $class();
  }

  protected static function validateClass($class) {
    if (class_exists($class) && !in_array($class, self::$stubbedClasses)) {
      throw new \Exception("Class {$class} already exists");
    }
  }

  protected static function createClassIfNeeded($class) {
    if (!in_array($class, self::$stubbedClasses)) {
      $classDef = <<<EOF

use PhunIt\Stub\Stub;

class $class extends Stub {
}

EOF;
      eval($classDef);
      self::$stubbedClasses[] = $class;
    }
  }

}