<?php 
class user {
	public 	$id,		
		$description,
		$password = null;	
	
	private $isNew = true;
			
	public function __construct($id = null) {		
		if(!empty($id)) {
			$sql = 'SELECT * FROM users WHERE id = '.$id;
			$result = mysql_fetch_assoc(mysql_query($sql)) or die ('Error executing SQL Statement: "'.$sql.'"');
	
			$this->id = $result['id'];			
			$this->description = $result['description'];
			$this->password = $result['password'];		
			
			$this->isNew = false;			
		}
	}
	
	//homepage moet verkregen worden uit configuration.php...
	public function Update(){
		$sql = null;

		if(!$this->isNew){
			$sql = 'UPDATE 	`homepage`.`users` 
				SET 	`description` = \''.$this->description.'\',
					`password` = \''.$this->password.'\'						
				WHERE 	`users`.`id` = '.$this->id.' LIMIT 1;'; 
		}else{
			$sql = 'INSERT INTO `homepage`.`users` (`id`, `description`, `password`) 
			VALUES (NULL, 
				\''.$this->description.'\',
				\''.$this->password.'\');';
		}

		mysql_query($sql) or die ('Error executing SQL Statement: "'.$sql.'"');		
	}
	
	//homepage moet verkregen worden uit configuration.php...
	public function Delete(){
		$sql = "DELETE FROM `homepage`.`users` WHERE id = ".$this->id;
		mysql_query($sql) or die ('Error executing SQL Statement: "'.$sql.'"');
	}
	
	public static function getAll(){
		$sql = 'SELECT id FROM users';
		$result = mysql_query($sql) or die ('Error executing SQL Statement: "'.$sql.'"');

		$users = array();		
		while($user_id = mysql_fetch_assoc($result)) {
			$user = new user($user_id['id']);
			$users[] = $user;
		}
		return $users;	
	}

	public function isNew(){
		return $this->isNew;
	}

/*
	public static function getAllInOrder($date = null){		
		//$date = date('Y-m-d');		
		$date = (empty($date)) ? Configuration::STARTDATE : $date;
		//$sql = 'SELECT appointmentID FROM appointment WHERE DATE(startTime) = \''.$date.'\' ORDER BY endTime ASC, rating ASC';		
		$sql = 'SELECT appointmentID FROM appointment WHERE DATE(startTime) = \''.$date.'\' ORDER BY `order` ASC';		
		$result = mysql_query($sql);
		$output = array();		
		while($app = mysql_fetch_assoc($result)) {
			$appointment = new appointment($app['appointmentID']);
			$output[] = $appointment;
		}
		return $output;	
	}
	
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
		$output = '<b>user: </b>';
		$output .= $this->id.' - ';		
		$output .= $this->description;		
		return $output;
	}
	
}
?>
