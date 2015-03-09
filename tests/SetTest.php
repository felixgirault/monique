<?php

use PHPUnit_Framework_TestCase as TestCase;
use Monique\Set;
use Monique\Optional;



/**
 *
 */
class SetTest extends TestCase {

	/**
	 *
	 */
	public function testValue() {
		$values = [1, 2];
		$Set = new Set($values);

		$this->assertEquals($values, $Set->value());
	}

	/**
	 *
	 */
	public function testBind() {
		$values = [
			1,
			new Optional(2),
			new Optional()
		];

		$double = function($value) {
			return $value * 2;
		};

		$Set = new Set($values);

		$this->assertEquals(
			[2, 4, null],
			$Set->bind($double)->value()
		);

		$this->assertEquals(
			[4, 8, null],
			$Set->bind($double)->bind($double)->value()
		);
	}
}
