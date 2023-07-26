<?php
/**
 * An interface for classes that have hooks to register.
 */

namespace WPEasy\Abstracts\Interfaces;

/**
 * Interface - Registrable
 */
interface Registrable {
	/**
	 * Register hooks.
	 *
	 * @return void
	 */
	public function register_hooks();
}
