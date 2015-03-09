<?php

namespace Monique;

use Monique\Monad;
use Exception;



/**
 *
 */
class Optional extends Monad {

	/**
	 *
	 */
	public function __construct($value = null) {
		parent::__construct($value);
	}

	/**
	 *
	 */
	public function hasValue() {
		return ($this->_value !== null);
	}

	/**
	 *
	 */
	public function valueOr($default) {
		return $this->value() ?: $default;
	}

	/**
	 *
	 */
	public function bind(callable $fn) {
		if (!$this->hasValue()) {
			return $this;
		}

		return parent::bind($fn);
	}
}
