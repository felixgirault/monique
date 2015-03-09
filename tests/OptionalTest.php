<?php

use PHPUnit_Framework_TestCase as TestCase;
use Monique\Optional;



/**
 *
 */
class OptionalTest extends TestCase {

	/**
	 *
	 */
	public function testHasValue() {
		$Just = new Optional(1);
		$Nothing = new Optional();

		$this->assertTrue($Just->hasValue());
		$this->assertFalse($Nothing->hasValue());
	}

	/**
	 *
	 */
	public function testBind() {
		$value = 10;
		$half = function($value) {
			return ($value % 2)
				? new Monique\Optional()
				: new Monique\Optional($value / 2);
		};

		$Optional = new Optional($value);

		$this->assertEquals(
			$half($value),
			$Optional->bind($half)
		);

		$this->assertEquals(
			$half($half($value)->value()),
			$Optional->bind($half)->bind($half)
		);
	}
}
