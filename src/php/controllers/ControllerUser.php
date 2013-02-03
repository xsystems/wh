<?php
class userController {	
	
	public static function getUserById($id = null) {
		if(empty($id)) {
			return false;
		}
		
		return new user($id);
	}
	
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

	public static function getAll(){
		return user::getAll();
	}

	public static function hasAcces($id = NULL){
		$user = new user($id);

		return !$user->isNew();			
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
	
		
	
	/*
	public static function getAllInOrder($date){
		return appointment::getAllInOrder($date);
	}
	*/
}
?>
