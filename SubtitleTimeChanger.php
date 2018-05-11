<?php

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
	protected static $_instance = null;

	public static function shared()
	{
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new SubtitleTimeChanger;
		}

		return self::$_instance;
	}
	
	public function get_alphabets()
	{
		$characters = [];

		for ( $i = 65; $i <= 90; $i++ ) { 
			$characters[] = chr($i);
		}

		for ( $i = 97; $i <= 122; $i++ ) { 
			$characters[] = chr($i);
		}

		return $characters;
	}

	public function get_numbers()
	{
		$numbers = [];

		for ( $i = 0; $i < 10; $i++ ) { 
			$numbers[] = "{$i}";
		}

		return $numbers;
	}

	public function get_intervals( $subtitle )
	{
		$exploded = explode( "\n", $subtitle );

		foreach ( $exploded as $key => $value )
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

var_dump(SubtitleTimeChanger::shared()->get_intervals( $string ));