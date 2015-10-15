<?php

use PHPUnit_Framework_TestCase as TestCase;
use Monique\Set;



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
}
