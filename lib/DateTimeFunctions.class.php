<?php
/**
 * DateTimeFunctions class
 * 
 * This class contains all methods used for formatting date/time data.
 * 
 * @author Bliss - March 2008
 * @package DateTime
 */

class DateTimeFunctions {
	/**
	 * Time format used in database
	 */
	const DB_TIME_FORMAT 		= "Y-m-d";
	
	/**
	 * DateTime format used for output
	 */
	const OUTPUT_DATETIME_FORMAT 	= "d F Y H:i:s";

	/**
	 * Date format used for output
	 */
	const OUTPUT_DATE_FORMAT 	= "d F Y";

	/**
	 * Time format used for output
	 */
	const OUTPUT_TIME_FORMAT 	= "H:i:s";
	
	/**
	 * Number of days in a leap year
	 *
	 */
	const NUM_DAYS_IN_LEAP_YEAR = 366;
	
	/**
	 * Number of days in a regular year
	 *
	 */
	const NUM_DAYS_IN_REGULAR_YEAR = 365;
	
	const NUM_SECONDS_IN_DAY = 86400;

	/**
	 * Creates a timestamp from a database date field
	 *
	 * @param date $str
	 * @return timestamp
	 */
	static function dateToTimestamp($str) {	
		list($date, $time) = explode(" ", $str);
		list($year, $month, $day) = explode('-', $date);
		list($hour, $minute, $second) = explode(':', $time);

		$year = intval($year);
		$month = intval($month);
		$day = intval($day);
		$hour = intval($hour);
		$minute = intval($minute);
		$second = intval($second);		

		$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
		return $timestamp;
	}
		
	/**
	 * Formats a timestamp to the OUTPUT_DATETIME_FORMAT
	 *
	 * @param datetime_from_db $date
	 * @return formatted_datetime
	 */ 
	static function formatDateTime($datetime){
		return date(self::OUTPUT_DATETIME_FORMAT,self::dateToTimestamp($datetime));		
	}

	/**
	 * Formats a timestamp to the OUTPUT_DATE_FORMAT
	 *
	 * @param date_from_db $date
	 * @return formatted_date
	 */ 
	static function formatDate($date){
		return date(self::OUTPUT_DATE_FORMAT,self::dateToTimestamp($date));		
	}

	/**
	 * Formats a timestamp to the OUTPUT_TIME_FORMAT
	 *
	 * @param time_from_db $time
	 * @return formatted_time
	 */ 
	static function formatTime($time){
		return date(self::OUTPUT_TIME_FORMAT,self::dateToTimestamp($time));		
	}
	
	/**
	 * Rewrites an outputted date to the database format, so it can be stored
	 *
	 * @param date $date
	 * @return date_in_db_format
	 */
	static function reverseFormatDate($date) {
		list($day, $month, $year) = explode('-', $date);
		$year = intval($year);
		$month = intval($month);
		$day = intval($day);
		$timestamp = mktime(0,0,0,$month,$day,$year);
		return date(self::DB_TIME_FORMAT ,$timestamp);
	}
	
	/**
	 * Gets the number of days in year $year
	 *
	 * @param int $year
	 * @return int Number of days in $year
	 */
	
	static function numberOfDaysInYear($year) {		
		if(self::isLeapYear($year)) {
			return self::NUM_DAYS_IN_LEAP_YEAR ;
		}
		else {
			return self::NUM_DAYS_IN_REGULAR_YEAR;
		}
	}
	
	/**
	 * Gets the number of days in a $month in $year
	 *
	 * @param int $month
	 * @param int $year
	 * @return int Number of days
	 */
	static function numDaysInMont($month,$year) {
		return date('t',mktime(1,1,1,$month,1,$year));
	}
	
	/**
	 * Creates a two-dimensional array containing months, days and a boolean for 'weekend'
	 *
	 * @param int $year
	 * @return array Containing days of that year.
	 */
	static function createDaysArray($year) {
		$result = array();
		$dayCounter = 1;
		
		for($month = 1;$month <= 12; $month++) {
			for($day = 1;$day <= self::numDaysInMont($month,$year); $day++) {
				$timeStamp = mktime(1,1,1,$month,$day,$year);
				$result[$month][$dayCounter]['description'] = date(self::OUTPUT_TIME_FORMAT,$timeStamp);
				$result[$month][$dayCounter]['weekend'] = self::isDayInWeekend($timeStamp);
				$dayCounter++;
			}
		}
		return $result;
	}
	
	/**
	 * Determines wether a certain day is in the weekend
	 *
	 * @param timeStamp $timeStamp
	 * @return bool True if day is weekend day
	 */
	static function isDayInWeekend($timeStamp) {
		if (date('N',$timeStamp) >= 6)
			return true;
		else 
			return false;
	}
	
	/**
	 * Determines wether day is a saturday
	 *
	 * @param int $day
	 * @param int $month
	 * @param int $year
	 * @return bool True if day is a saturday
	 */
	static function isSaturday($day,$month,$year) {
		$timeStamp = mktime(1,1,1,$month,$day,$year);
		return (date('N',$timeStamp) == 6);
	}
	
	/**
	 * Determines wether day is a sunday
	 *
	 * @param int $day
	 * @param int $month
	 * @param int $year
	 * @return bool True if day is a sunday
	 */
	static function isSunday($day,$month,$year) {
		$timeStamp = mktime(1,1,1,$month,$day,$year);
		return (date('N',$timeStamp) == 7);		
	}
	
	/**
	 * Checks if year is leap year
	 * 
	 * @link http://en.wikipedia.org/wiki/Leap_year
	 * @param int $year
	 * @return true if year is leap year
	 */
	static function isLeapYear($year) {
		if($year % 4 == 0 && $year % 100 != 0 || $year % 400 == 0) {
		return true;
		}
		else {
			return false;
		}
	}
	
	static function thisMonth() {
		return $maand = date('n');
	}
	static function thisYear() {
		return $jaar = date('Y');
	}
	
	static function getMonthName($month) {
		$MONTHS = array(1=>'Januari',2=>'Februari',3=>'Maart',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Augustus',9=>'September',10=>'Oktober',11=>'November',12=>'December');
		return $MONTHS[$month];
	}
	
	static function getDayOfTheYear($dateInDBFormat) {
		return date('z',self::dateToTimestamp($dateInDBFormat));
	}
	
	static function getDayOfTheYear2($day,$month,$year) {
		return date('z',mktime(1,1,1,$month,$day,$year));
	}
	
	static function getMonth($dateInDBFormat) {
		return date('n',self::dateToTimestamp($dateInDBFormat));
	}
	
	static function addDaysToDate($date,$days = 1) {
		$date = self::dateToTimestamp($date);
		$date = $date + ($days*self::NUM_SECONDS_IN_DAY);
		return date(self::DB_TIME_FORMAT,$date);
	}
	static function subtractDaysFromDate($date,$days = 1) {
		$date = self::dateToTimestamp($date);
		$date = $date - ($days*self::NUM_SECONDS_IN_DAY);
		return date(self::DB_TIME_FORMAT,$date);
	}
}
?>
