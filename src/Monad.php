<?php

namespace Monique;



/**
 *
 */
class Monad {

	/**
	 *
	 */
	protected $_value = null;

	/**
	 *
	 */
	public function __construct($value) {
		$this->_value = self::unwrap($value);
	}

	/**
	 *
	 */
	public function value() {
		return $this->_value;
	}

	/**
	 *
	 */
	public function bind(callable $fn) {
		return self::wrap(
			call_user_func($fn, $this->_value)
		);
	}

	/**
	 *
	 */
	public static function wrap($value) {
		return ($value instanceof self)
			? $value
			: new static($value);
	}

	/**
	 *
	 */
	public static function unwrap($value) {
		return ($value instanceof self)
			? $value->value()
			: $value;
	}
}
