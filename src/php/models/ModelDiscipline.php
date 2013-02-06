<?php 

class Discipline 
{
	private $db,
            $dbh;

	public 	$id,
            $name,
            $description,
            $image_folder_location;		
			
	public function __construct($db, $id = null) 
	{
		$this->db = $db;
		$this->dbh = $this->db->getDBH();
	
		if($id) 
		{
			$this->dbh->beginTransaction();
			
			$stmt = self::$dbh->prepare("SELECT * FROM discipline WHERE id = :id");
    			$stmt->bindParam(':id', $id);					
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_INTO, $this);	
			$stmt->fetch();
			
			$this->dbh->commit();		
		}
	}	

	public function update()
	{
		if($this->id)
		{	
			$this->dbh->beginTransaction();
			
			$stmt = $this->dbh->prepare("UPDATE discipline SET name=:name, description=:description, image_folder_location=:image_folder_location WHERE id=:id");
    			$stmt->bindParam(':id', $this->id);
    			$stmt->bindParam(':name', $this->name);
    			$stmt->bindParam(':description', $this->description);
    			$stmt->bindParam(':image_folder_location', $this->image_folder_location);					
			$stmt->execute();
			
			$this->dbh->commit();
		}
		else
		{
			$this->dbh->beginTransaction();
			
			$stmt = $this->dbh->prepare("INSERT INTO discipline (name, description, image_folder_location) VALUES (:name, :description, :image_folder_location)");
    			$stmt->bindParam(':name', $this->name);
    			$stmt->bindParam(':description', $this->description);
    			$stmt->bindParam(':image_folder_location', $this->image_folder_location);					
			$stmt->execute();
			$this->id=$this->dbh->lastInsertId();
			
			$this->dbh->commit();
		}
	}
	
	public function delete()
	{
		if($this->id)
		{
			$this->dbh->beginTransaction();
			
			$stmt = $this->dbh->prepare("DELETE FROM discipline WHERE id=:id");
    			$stmt->bindParam(':id', $this->id);					
			$stmt->execute();
			
			$this->dbh->commit();		
		}
	}

	public static function getAll($db)
	{		
		$dbh = $db->getDBH();
	
		$dbh->beginTransaction();
	
		$stmt = $dbh->prepare("SELECT * FROM discipline");
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Discipline', array($db));	
		$disciplines = $stmt->fetchAll();
	
		$dbh->commit();	
		
		return $disciplines;	
	}
	
	public static function getNames($db)
	{		
		$dbh = $db->getDBH();
	
		$dbh->beginTransaction();
	
		$stmt = $dbh->prepare("SELECT name FROM discipline");
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);	
		$disciplineNames = $stmt->fetchAll();
	
		$dbh->commit();	
		
		return $disciplineNames;	
	}
	
	public static function getByName($db, $name)
	{		
		$dbh = $db->getDBH();
	
		$dbh->beginTransaction();
	
		$stmt = $dbh->prepare("SELECT * FROM discipline WHERE name=:name");
		$stmt->bindParam(':name', $name);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Discipline', array($db));	
		$discipline = $stmt->fetch();
	
		$dbh->commit();	
		
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
