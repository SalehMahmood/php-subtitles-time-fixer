<?php

/**
 * An object that helps you change subtitles time
 *
 * Created on: ‎May ‎11, ‎2018 09:52:00 (UTC)
 * Created by: Saleh Mahmood (@theSalehMahmood)
 * 
 * @author Saleh Mahmood
 * @package SubtitlesTimeFixer
 */
final class SubtitlesTimeFixer
{
	/**
	 * A blank instance
	 *
	 * @var (object) SubtitlesTimeFixer
	 * @static
	 */
	protected static $_instance = null;

	/**
	 * Returns a static instance of current class
	 *
	 * @access public
	 * @static
	 * @return (object) SubtitlesTimeFixer
	 */
	public static function shared(): SubtitlesTimeFixer
	{
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new SubtitlesTimeFixer;
		}

		return self::$_instance;
	}

	/**
	 * Returns all small and capital English alphabets
	 *
	 * @access public
	 * @return (array) $characters All English alphabets
	 */
	public function get_alphabets(): array
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
	public function get_numbers(): array
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
	public function parse_subs_time_differ( string $subtitle, int $diff, bool $do_add = true ): SubtitlesTimeFixer
	{

		$subs_explosion = explode( "\n", $subtitle ); // Indexing each line into array

		foreach ( $subs_explosion as $key => $value )
		{
			if ( (in_array( substr($value, 0, 1), $this->get_numbers() )) && substr($value, 2, 1) === ':' ) {
				$search_start_time = strstr( $value, ',', true );
				$replace_start_time = $this->change_time( $search_start_time, $diff, $do_add );

				$search_end_time = str_replace( '> ', '', strstr( strstr( $value, '>' ), ',', true ) );
				$replace_end_time = $this->change_time( $search_end_time, $diff, $do_add );

				$rep = $subs_explosion[$key] = preg_replace( '/' . $search_start_time . '/', $replace_start_time, $value );
				$subs_explosion[$key] = preg_replace( '/' . $search_end_time . '/', $replace_end_time, $rep );
			}
		}

		$this->srt = $subs_implosion = implode( "\n", $subs_explosion );

		return $this;
	}

	/**
	 * Returns changed time
	 *
	 * @access public
	 *
	 * @param string $time Subtitle to parse
	 * @param string $diff Subtitle to parse
	 * @param string $do_add Subtitle to parse
	 *
	 * @return string DateTime Changed time
	 */
	public function change_time( string $time, int $diff, bool $do_add = true )
	{
		return (new DateTime)
		        ->setTimestamp( 
		        	$do_add ? strtotime($time) + $diff : strtotime($time) - $diff 
		        )
		        ->format('H:i:s');
	}

	/**
	 * Returns subtitles content
	 *
	 * @access public
	 *
	 * @param string $time Subtitle to parse
	 * @param string $diff Subtitle to parse
	 * @param string $do_add Subtitle to parse
	 *
	 * @return string DateTime Changed time
	 */
	public function get_subtitle(): string
	{
		return $this->srt;
	}
}

// $subs_sample = file_get_contents( 'sample.srt' );

// var_dump( $subs_sample );

// $intervals = SubtitlesTimeFixer::shared()->parse_subs_time_differ ( $subs_sample, 44 );

// echo $intervals->get_subtitle();

// var_dump( $intervals );