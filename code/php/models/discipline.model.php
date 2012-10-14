<?php 
require_once('../configuration/framework.php');

class Discipline 
{
	private static  $db,
                    $dbh;

	public 	$id,
            $name,
            $description,
            $image_folder_location;		
			
	public function __construct($id = null) 
	{
		self::$db = Database::getInstance(Configuration::$DB_PATH, Configuration::$DB, Configuration::$DB_ERRMODE);
		self::$dbh = self::$db->getDBH();
	
		if($id) {
			self::$dbh->beginTransaction();
			
			$stmt = self::$dbh->prepare("SELECT * FROM discipline WHERE id = :id");
    			$stmt->bindParam(':id', $id);					
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_INTO, $this);	
			$stmt->fetch();
			
			self::$dbh->commit();		
		}
	}	

	public function update()
	{
		if($this->id)
		{	
			self::$dbh->beginTransaction();
			
			$stmt = self::$dbh->prepare("UPDATE discipline SET name=:name, description=:description, image_folder_location=:image_folder_location WHERE id=:id");
    			$stmt->bindParam(':id', $this->id);
    			$stmt->bindParam(':name', $this->name);
    			$stmt->bindParam(':description', $this->description);
    			$stmt->bindParam(':image_folder_location', $this->image_folder_location);					
			$stmt->execute();
			
			self::$dbh->commit();
		}
		else
		{
			self::$dbh->beginTransaction();
			
			$stmt = self::$dbh->prepare("INSERT INTO discipline (name, description, image_folder_location) VALUES (:name, :description, :image_folder_location)");
    			$stmt->bindParam(':name', $this->name);
    			$stmt->bindParam(':description', $this->description);
    			$stmt->bindParam(':image_folder_location', $this->image_folder_location);					
			$stmt->execute();
			$this->id=self::$dbh->lastInsertId();
			
			self::$dbh->commit();
		}
	}
	
	public function delete()
	{
		if($this->id)
		{
			self::$dbh->beginTransaction();
			
			$stmt = self::$dbh->prepare("DELETE FROM discipline WHERE id=:id");
    			$stmt->bindParam(':id', $this->id);					
			$stmt->execute();
			
			self::$dbh->commit();		
		}
	}

	public static function getAll()
	{		
		self::$db = Database::getInstance(Configuration::$DB_PATH, Configuration::$DB, Configuration::$DB_ERRMODE);
		self::$dbh = self::$db->getDBH();
	
		self::$dbh->beginTransaction();
	
		$stmt = self::$dbh->prepare("SELECT * FROM discipline");
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Discipline');	
		$disciplines = $stmt->fetchAll();
	
		self::$dbh->commit();	
		
		return $disciplines;	
	}
	
	public static function getNames()
	{		
		self::$db = Database::getInstance(Configuration::$DB_PATH, Configuration::$DB, Configuration::$DB_ERRMODE);
		self::$dbh = self::$db->getDBH();
	
		self::$dbh->beginTransaction();
	
		$stmt = self::$dbh->prepare("SELECT name FROM discipline");
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);	
		$disciplineNames = $stmt->fetchAll();
	
		self::$dbh->commit();	
		
		return $disciplineNames;	
	}
	
	public static function getByName($name)
	{		
		self::$db = Database::getInstance(Configuration::$DB_PATH, Configuration::$DB, Configuration::$DB_ERRMODE);
		self::$dbh = self::$db->getDBH();
	
		self::$dbh->beginTransaction();
	
		$stmt = self::$dbh->prepare("SELECT * FROM discipline WHERE name=:name");
		$stmt->bindParam(':name', $name);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Discipline');	
		$discipline = $stmt->fetch();
	
		self::$dbh->commit();	
		
		return $discipline;	
	}

	public function toString()
	{
		$output = 'discipline: ';
		$output .= $this->id.' - ';
		$output .= $this->name.' - ';
		$output .= $this->description.' - ';
		$output .= $this->image_folder_location;		
		return $output;
	}	
}
?>
