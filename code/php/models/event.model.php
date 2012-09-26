<?php 
class event {
	public 	$id,
		$name,
		$datetime,
		$description;		
	
	private $isNew = true;
			
	public function __construct($id = null) {		
		if($id!=null) {
			$sql = 'SELECT * FROM events WHERE id = '.$id;
			$result = mysql_fetch_assoc(mysql_query($sql)) or die ('Error executing SQL Statement: "'.$sql.'"');
	
			$this->id = $result['id'];
			$this->name = $result['name'];
			$this->datetime = $result['datetime'];
			$this->description = $result['description'];		
			
			$this->isNew = false;			
		}
	}
	
	//homepage moet verkregen worden uit configuration.php...
	public function Update(){
		$sql = null;

		if(!$this->isNew){
			$sql = 'UPDATE `homepage`.`events` 
				SET 	`name` = \''.$this->name.'\', 
					`datetime` = \''.$this->datetime.'\', 
					`description` = \''.$this->description.'\'						
				WHERE `events`.`id` = '.$this->id.' LIMIT 1;'; 
		}else{
			$sql = 'INSERT INTO `homepage`.`events` (`id`, `name`, `datetime`, `description`) 
			VALUES (NULL, 
				\''.$this->name.'\', 
				\''.$this->datetime.'\',
				\''.$this->description.'\');';
		}

		mysql_query($sql) or die ('Error executing SQL Statement: "'.$sql.'"');		
	}
	
	//homepage moet verkregen worden uit configuration.php...
	public function Delete(){
		$sql = "DELETE FROM `homepage`.`events` WHERE id = ".$this->id;
		mysql_query($sql) or die ('Error executing SQL Statement: "'.$sql.'"');
	}
	
	public static function getAll(){
		$sql = 'SELECT id FROM events';
		$result = mysql_query($sql) or die ('Error executing SQL Statement: "'.$sql.'"');

		$events = array();		
		while($event_id = mysql_fetch_assoc($result)) {
			$event = new event($event_id['id']);
			$events[] = $event;
		}
		return $events;	
	}


	public static function getAllInOrder($date = null){				
		//$date = (empty($date)) ? Configuration::STARTDATE : date('Y-m-d');
		//$sql = 'SELECT appointmentID FROM appointment WHERE DATE(startTime) = \''.$date.'\' ORDER BY endTime ASC, rating ASC';		
		$sql = 'SELECT id FROM events ORDER BY `datetime` ASC';		
		$result = mysql_query($sql);

		$events = array();		
		while($e = mysql_fetch_assoc($result)) {
			$event = new event($e['id']);
			$events[] = $event;
		}
		return $events;	
	}

/*	
	public static function getNextAppointmentInOrder($appointmentId) {
		$current = new appointment($appointmentId);
		$sql = 'SELECT appointmentID FROM appointment WHERE DATE(startTime) = DATE(\''.$current->startTime.'\') AND `order` > '.$current->order.' ORDER BY `order` ASC LIMIT 1';
		$result = mysql_query($sql);
		if(mysql_num_rows($result) == 0)
			return false;
		$resultRow = mysql_fetch_assoc($result);
		return new appointment($resultRow['appointmentID']);
	}
	
	public static function getPreviousAppointmentInOrder($appointmentId) {
		$current = new appointment($appointmentId);
		$sql = 'SELECT appointmentID FROM appointment WHERE DATE(startTime) = DATE(\''.$current->startTime.'\') AND `order` < '.$current->order.' ORDER BY `order` DESC LIMIT 1';
		$result = mysql_query($sql);
		if(mysql_num_rows($result) == 0)
			return false;
		$resultRow = mysql_fetch_assoc($result);
		return new appointment($resultRow['appointmentID']);
	}	
*/

	public function toString(){
		$output = '<b>event: </b>';
		$output .= $this->id.' - ';
		$output .= $this->name.' - ';
		$output .= $this->datetime.' - ';
		$output .= $this->description;		
		return $output;
	}
	
}
?>
