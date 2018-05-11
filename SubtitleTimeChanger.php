<?php

/**
 * An object that helps you change subtitles time
 *
 * Created on: ‎May ‎11, ‎2018 09:52:00 (UTC)
 * Created by: Saleh Mahmood (@theSalehMahmood)
 * 
 * @author Saleh Mahmood
 * @package SubtitleTimeChanger
 */
final class SubtitleTimeChanger
{
	/**
	 * A blank instance
	 *
	 * @var (object) SubtitleTimeChanger
	 * @static
	 */
	protected static $_instance = null;

	/**
	 * Returns a static instance of current class
	 *
	 * @access public
	 * @static
	 * @return (object) SubtitleTimeChanger
	 */
	public static function shared()
	{
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new SubtitleTimeChanger;
		}

		return self::$_instance;
	}

	/**
	 * Returns all small and capital English alphabets
	 *
	 * @access public
	 * @return (array) $characters All English alphabets
	 */
	public function get_alphabets()
	{
		$characters = []; // Removing PHP Notice
		for( $i = 65; $i <=  122; $i++ ) 
			if( ! ($i > 90 && $i < 97) ) $characters[] = chr($i);

		return $characters;
	}

	/**
	 * Returns all small and capital English alphabets
	 *
	 * @access public
	 * @return (array) $characters All English alphabets
	 */
	public function get_numbers()
	{
		$numbers = [];// Removing PHP Notice
		for ( $i = 0; $i < 10; $i++ ) $numbers[] = "{$i}";

		return $numbers;
	}

	/**
	 * Returns all small and capital English alphabets
	 *
	 * @access public
	 * @param string $subtitle Subtitle to parse
	 * @return (array) $intervals All intervals in a supplied subtitle
	 *
	 * @see get_numbers()
	 */
	public function get_intervals( $subtitle )
	{
		$subs_explosion = explode( "\n", $subtitle ); // Indexing each line into array

		foreach ( $subs_explosion as $key => $value )
		{
			if ( (in_array( substr($value, 0, 1), $this->get_numbers() )) && substr($value, 2, 1) === ':' ) {
				$time_start = strstr( $value, ',', true );
				$time_end = str_replace( '> ', '', strstr( strstr( $value, '>' ), ',', true ) );

				$intervals[] = [ $time_start, $time_end ];
			}
		}

		array_unshift( $intervals, 'temp' );
		unset( $intervals[0] );

		return $intervals;
	}
}

$subs_sample = "1
00:00:37,523 --> 00:00:38,652
They are late.

2
00:01:57,000 --> 00:02:00,130
Brenda, we're coming from behind. Keep them busy.
- Hold on.

3
00:02:11,919 --> 00:02:13,000
Report it.

4
00:02:14,074 --> 00:02:16,762
Transport zero-one-nine, we
have problems on the track.

549
00:02:16,764 --> 00:02:21,276
<i>Mile 23, send back up.
- Understood. On the way.</i>
";

var_dump( SubtitleTimeChanger::shared()->get_intervals( $subs_sample ) );