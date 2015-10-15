<?php

namespace Monique;

use Monique\Option\None;
use Monique\Option\Some;
use Exception;



/**
 *
 */
abstract class Option {

	/**
	 *
	 */
	private $value = null;

	/**
	 *
	 */
	public function __construct($value = null) {
		$this->value = $value;
	}

	/**
	 *
	 */
	public function isNone() {
		return $this->value === null;
	}

	/**
	 *
	 */
	public function isSome() {
		return $this->value !== null;
	}

	/**
	 *
	 */
	public function expect($message) {
		if ($this->isNone()) {
			throw new Exception($message);
		}

		return $this->value;
	}

	/**
	 *
	 */
	public function unwrap() {
		if ($this->isNone()) {
			throw new Exception(
				'Called `Option::unwrap()` on a `None` value'
			);
		}

		return $this->value;
	}

	/**
	 *
	 */
	public function unwrapOr($default) {
		return $this->isSome()
			 ? $this->value
			 : $default;
	}

	/**
	 *
	 */
	public function unwrapOrElse(callable $default) {
		return $this->isSome()
			? $this->value
			: $default();
	}

	/**
	 *
	 */
	public function map(callable $fn) {
		return $this->isSome()
			? new Some($fn($this->value))
			: new None();
	}

	/**
	 *
	 */
	public function mapOr(callable $fn, $default) {
		return $this->isSome()
			? $fn($this->value)
			: $default;
	}

	/**
	 *
	 */
	public function mapOrElse(callable $fn, callable $default) {
		return $this->isSome()
			? $fn($this->value)
			: $default();
	}

	/**
	 *
	 */
	public function andOption(Option $other) {
		return $this->isSome()
			? $other
			: new None();
	}

	/**
	 *
	 */
	public function andThen(callable $fn) {
		return $this->isSome()
			? $fn($this->value)
			: new None();
	}

	/**
	 *
	 */
	public function orOption(Option $other) {
		return $this->isSome()
			? $this
			: $other;
	}

	/**
	 *
	 */
	public function orElse(callable $fn) {
		return $this->isSome()
			? $this
			: $fn();
	}
}
