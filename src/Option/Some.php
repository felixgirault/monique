<?php

namespace Monique\Option;

use Monique\Option;
use InvalidArgumentException;



/**
 *
 */
class Some extends Option {

	/**
	 *
	 */
	public function __construct($value) {
		if ($value === null) {
			throw new InvalidArgumentException(
				"The value should not be null"
			);
		}

		parent::__construct($value);
	}
}
