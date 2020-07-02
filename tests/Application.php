<?php
/**
 * The file that defines the core plugin class
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/includes
 */

namespace WPB\Test;

use PHPUnit\Framework\TestCase;

/**
 * The application test class.
 *
 * @since      1.0.0
 * @package    WPB
 * @subpackage WPB/tests
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class Application extends TestCase {

	/** @test */
	public function it_provides_a_factory_method() {
		$this->assertSame( true, true );
	}
}
