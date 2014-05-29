<?php
namespace TimeKeywords;

include( "src/Initializer.php" );

use DateTime;
use DateTimeZone;
use TimeKeywords\ITimeKeyword;

/**
 * Default TimeKeyword. The time is the current time.
 * @author Josef Weibel <a href="http://www.josefweibel.ch">www.josefweibel.ch</a>
 */
class NowTimeKeyword implements ITimeKeyword
{
	/**
	 * @var string the keyword of this TimeKeyword.
	 */
	protected $keyword = "jetzt";

	/**
	 * @return string check if the keyword is at the end.
	 */
	public function getPattern()
	{
		return "/ " . $this->keyword . "$/";
	}

	/**
	 * @param string $query
	 * @return string the query without the keyword at the end.
	 */
	public function removeTimeKeyword( $query )
	{
		$pos = strripos( $query, " " . $this->keyword );
		if( $pos === false )
		{
			return $query;
		}
		else
		{
			return substr_replace( $query, "", $pos, strlen( $this->keyword ) + 1 );
		}
	}

	/**
	 * @param string $query
	 * @return \DateTime the current time.
	 */
	public function getTime( $query )
	{
		$timezone = new DateTimeZone( "Europe/Zurich" );
		return new DateTime( "now", $timezone );
	}

	/**
	 * @return the translated keyword.
	 */
	public function getKeyword()
	{
		return $this->keyword;
	}
}