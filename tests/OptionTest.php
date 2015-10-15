<?php

use PHPUnit_Framework_TestCase as TestCase;
use Monique\Option;
use Monique\Option\None;
use Monique\Option\Some;



/**
 *
 */
class OptionTest extends TestCase {

	/**
	 *
	 */
	public function testIsNone() {
		$none = new None();
		$some = new Some(12);

		$this->assertTrue($none->isNone());
		$this->assertFalse($some->isNone());
	}

	/**
	 *
	 */
	public function testIsSome() {
		$none = new None();
		$some = new Some(12);

		$this->assertFalse($none->isSome());
		$this->assertTrue($some->isSome());
	}

	/**
	 *
	 */
	public function testExpectNone() {
		$None = new None();
		$message = 'Message';

		$this->setExpectedException('\\Exception', $message);
		$None->expect($message);
	}

	/**
	 *
	 */
	public function testExpectSome() {
		$value = 12;
		$Some = new Some($value);

		$this->assertEquals($value, $Some->expect(''));
	}

	/**
	 *
	 */
	public function testUnwrapNone() {
		$None = new None();

		$this->setExpectedException('\\Exception');
		$None->unwrap();
	}

	/**
	 *
	 */
	public function testUnwrapSome() {
		$value = 12;
		$Some = new Some($value);

		$this->assertEquals($value, $Some->unwrap());
	}

	/**
	 *
	 */
	public function testUnwrapOr() {
		$value = 12;
		$default = 6;
		$None = new None();
		$Some = new Some($value);

		$this->assertEquals($default, $None->unwrapOr($default));
		$this->assertEquals($value, $Some->unwrapOr($default));
	}

	/**
	 *
	 */
	public function testUnwrapOrElse() {
		$value = 12;
		$default = function() {
			return 6;
		};

		$None = new None();
		$Some = new Some($value);

		$this->assertEquals($default(), $None->unwrapOrElse($default));
		$this->assertEquals($value, $Some->unwrapOrElse($default));
	}

	/**
	 *
	 */
	public function testMap() {
		$fn = function($v) {
			return $v * 2;
		};

		$None = new None();
		$Some = new Some(6);

		$this->assertEquals(new None(), $None->map($fn));
		$this->assertEquals(new Some(12), $Some->map($fn));
	}

	/**
	 *
	 */
	public function testMapOr() {
		$fn = function($v) {
			return $v * 2;
		};

		$default = 6;
		$None = new None();
		$Some = new Some(6);

		$this->assertEquals($default, $None->mapOr($fn, $default));
		$this->assertEquals(12, $Some->mapOr($fn, $default));
	}

	/**
	 *
	 */
	public function testMapOrElse() {
		$fn = function($v) {
			return $v * 2;
		};

		$default = function() {
			return 6;
		};

		$None = new None();
		$Some = new Some(6);

		$this->assertEquals($default(), $None->mapOrElse($fn, $default));
		$this->assertEquals(12, $Some->mapOrElse($fn, $default));
	}

	/**
	 *
	 */
	public function testAndOption() {
		$this->assertEquals(new None(), (new None())->andOption(new None()));
		$this->assertEquals(new None(), (new None())->andOption(new Some(6)));
		$this->assertEquals(new None(), (new Some(12))->andOption(new None()));
		$this->assertEquals(new Some(6), (new Some(12))->andOption(new Some(6)));
	}

	/**
	 *
	 */
	public function testAndThen() {
		$fn = function($v) {
			return new Some($v * 2);
		};

		$this->assertEquals(new None(), (new None())->andThen($fn));
		$this->assertEquals(new Some(12), (new Some(6))->andThen($fn));
	}

	/**
	 *
	 */
	public function testOrOption() {
		$this->assertEquals(new None(), (new None())->orOption(new None()));
		$this->assertEquals(new Some(6), (new None())->orOption(new Some(6)));
		$this->assertEquals(new Some(12), (new Some(12))->orOption(new None()));
		$this->assertEquals(new Some(12), (new Some(12))->orOption(new Some(6)));
	}

	/**
	 *
	 */
	public function testOrThen() {
		$fn = function() {
			return new Some(12);
		};

		$this->assertEquals(new Some(12), (new None())->orElse($fn));
		$this->assertEquals(new Some(6), (new Some(6))->orElse($fn));
	}
}
