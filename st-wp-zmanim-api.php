<?php
/* 
	Plugin Name: WP Zmanim API
	Plugin URI: https://github.com/zmanim/zman
	Description: Simple port of Zmanim Zman API for WP to use via Shortcode
	Version: 1.0 | VSTWPZMAP1.0
	Author: Sommer Technologies
	Author URI: https://SommerTechs.com
	License: GPLv2 or later
	Text Domain: sommertechs-wp-zmanim
*/

	/**
	* Examples:
	* [get_zmanim_info] - Returns (int) day of the Jewish Year for current day
	* [get_zmanim_info date="1/1/2019"] - Returns (int) day of the Jewish Year for 1/1/2019
	* [get_zmanim_info date="1/1/2019" cat="jewishYear"] - Returns (int) Jewish Year for date 1/1/2019
	* 
	* Available Cat's
	* - jewishDay
	* - jewishMonth
	* - jewishYear
	* 
	* - jewishMonthName
	* - jewishMonthNameHebrew
	* - jewishDayHebrew
	* - jewishYearHebrew
	* 
	* - parsha
	* - parshaHebrew
	* - parshaInIsrael
	* - parshaInIsraelHebrew
	* 
	* - holidays
	* - holidaysHebrew
	*/

	if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }

	/* Load Zmanim Source */
		include_once( plugin_dir_path( __FILE__ ) . 'vendor/autoload.php');

		use Zman\Zman;
		
	/* Add Shortcode */	
		add_shortcode('get_zmanim_info', 'st_get_zmanim_info');
		function st_get_zmanim_info($atts){

			$atts = shortcode_atts(
			        array(
			            'date' => date('m/d/Y'),
			            'cat' => 'jewishDay',
			        ), $atts, 'sommertechs-wp-zmanim' );
				
			$Date = esc_html( $atts['date'] );
			$Cat = esc_html( $atts['cat'] );

			$Zman = new Zman($Date);

			return $Zman->$Cat;

		}