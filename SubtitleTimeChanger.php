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
	protected static $_instance = null;

	public static function shared()
	{
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new SubtitleTimeChanger;
		}

		return self::$_instance;
	}
}
