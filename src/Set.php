<?php

namespace Monique;

use Monique\Monad;
use InvalidArgumentException;



/**
 *
 */
class Set extends Monad {

	/**
	 *
	 */
	protected $_value = [];

	/**
	 *
	 */
	public function __construct($value) {
		if (!is_array($value) && !($value instanceof Traversable)) {
			throw new InvalidArgumentException();
		}

		parent::__construct($value);
	}

	/**
	 *
	 */
	public function value() {
		$results = [];

		foreach ($this->_value as $value) {
			$results[] = Monad::unwrap($value);
		}

		return $results;
	}

	/**
	 *
	 */
	public function bind(callable $fn) {
		$results = [];

		foreach ($this->_value as $value) {
			$results[] = Monad::wrap($value)->bind($fn);
		}

		return static::wrap($results);
	}
}
