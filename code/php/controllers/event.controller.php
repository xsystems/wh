<?php
class eventController {	
	
	public static function getEventById($id = null) {
		if(empty($id)) {
			return false;
		}
		
		return new event($id);
	}
	
	/*
	public static function getUserByDescription($description = null){		
		if(empty($description)) {
			return false;
		}

		$users = user::getAll();
		foreach($users as $user){
			if($user->description == $description){
				return $user;
			}
		}

		return false;
	}
	*/

	public static function getAll(){
		return event::getAll();
	}

	public static function getAllInOrder($date = NULL){
		return event::getAllInOrder($date);
	}	

	/*
	public static function insertAppointment($startTime,$endTime,$locationID,$rating,$type,$isConfirmed,$isFixed,$note,$client) {
		$appointment = new appointment();			
		
		$appointment->startTime = $startTime;
		$appointment->endTime = $endTime;
		$appointment->locationID = $locationID;
		$appointment->rating = $rating;
		$appointment->type = $type;
		$appointment->isConfirmed = $isConfirmed;
		$appointment->isFixed = $isFixed;
		$appointment->note = $note;
		$appointment->client = $client;
		
		$appointment->Update();
	}
	*/
}
?>
