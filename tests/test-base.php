<?php
/**
 * Vehicle_Search_Plugin.
 *
 * @since   1.0
 * @package Vehicle_Search_Plugin
 */
class Vehicle_Search_Plugin_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  1.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'Vehicle_Search_Plugin') );
	}

	/**
	 * Test that our main helper function is an instance of our class.
	 *
	 * @since  1.0
	 */
	function test_get_instance() {
		$this->assertInstanceOf(  'Vehicle_Search_Plugin', vehicle_search_plugin() );
	}

	/**
	 * Replace this with some actual testing code.
	 *
	 * @since  1.0
	 */
	function test_sample() {
		$this->assertTrue( true );
	}
}
