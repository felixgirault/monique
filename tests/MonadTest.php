<?php

use PHPUnit_Framework_TestCase as TestCase;
use Monique\Monad;



/**
 *
 */
class MonadTest extends TestCase {

	/**
	 *
	 */
	public function testValue() {
		$value = 12;
		$Monad = new Monad($value);

		$this->assertEquals($value, $Monad->value());
	}

	/**
	 *
	 */
	public function testBind() {
		$value = 12;
		$double = function($value) {
			return $value * 2;
		};

		$Monad = new Monad($value);

		$this->assertEquals(24, $Monad->bind($double)->value());
		$this->assertEquals(48, $Monad->bind($double)->bind($double)->value());
	}
}
