<?php

class Model{

	// database connection and table name
	private $conn;
	private $table_name = "model";

	// object properties
	public $id;
	public $model_name;
	public $manufacturer_id;
	public $color;
	public $manufacturing_year;
	public $registration_number;
	public $note;
	public $image_1;
	public $image_2;
	public $is_sold;
	
	// constructor with $db as database connection
	public function __construct($db){
		$this->conn = $db;
	}

	// create model
	function create(){
	 
	    // query to insert record
	    $query = "INSERT INTO
	                " . $this->table_name . "
	            SET
	                model_name=:model_name, manufacturer_id=:manufacturer_id,
	 				color=:color, manufacturing_year=:manufacturing_year,
	                note=:note, registration_number=:registration_number,
	                image_1=:image_1, image_2=:image_2";

	    // prepare query
	    $stmt = $this->conn->prepare($query);
	 
	    // sanitize
	    $this->model_name=htmlspecialchars(strip_tags($this->model_name));
	    $this->manufacturer_id=htmlspecialchars(strip_tags($this->manufacturer_id));
	    $this->color=htmlspecialchars(strip_tags($this->color));
	    $this->manufacturing_year=htmlspecialchars(strip_tags($this->manufacturing_year));
	    $this->registration_number=htmlspecialchars(strip_tags($this->registration_number));
	    $this->note=htmlspecialchars(strip_tags($this->note));
	    $this->image_1=htmlspecialchars(strip_tags($this->image_1));
	    $this->image_2=htmlspecialchars(strip_tags($this->image_2));
	 
	    // bind values
	    $stmt->bindParam(":model_name", $this->model_name);
	    $stmt->bindParam(":manufacturer_id", $this->manufacturer_id);
	    $stmt->bindParam(":color", $this->color);
	    $stmt->bindParam(":manufacturing_year", $this->manufacturing_year);
	    $stmt->bindParam(":registration_number", $this->registration_number);
	    $stmt->bindParam(":note", $this->note);
	    $stmt->bindParam(":image_1", $this->image_1);
	    $stmt->bindParam(":image_2", $this->image_2);

	    // execute query
	    if($stmt->execute()){
	        return true;
	    }
	    return false;
	}

	function readAll(){
		// select all query
	    $query = "SELECT p.id, p.model_name, 
	    			c.name as manufacturer_name 
	    			FROM " . $this->table_name . " as p 
	    			INNER JOIN manufacturer C 
	    			ON p.manufacturer_id = c.id 
	    			WHERE p.is_sold=0";

	    // prepare query statement
	    $stmt = $this->conn->prepare($query);
	    // execute query
	    $stmt->execute();
	    return $stmt;
	}

	function read(){
		// select all query
	    $query = "SELECT p.id, p.model_name, p.color, p.note, p.registration_number, 
	    			p.manufacturing_year, p.image_1, p.image_2, p.is_sold, 
	    			c.name as manufacturer_name 
	    			FROM " . $this->table_name . " as p 
	    			INNER JOIN manufacturer C 
	    			ON p.manufacturer_id = c.id
				    WHERE p.id=" . $this->id;

	    // prepare query statement
	    $stmt = $this->conn->prepare($query);

	    // bind id of product to be updated
	    $stmt->bindParam(1, $this->id);
	 
	    // execute query
	    $stmt->execute();
	 
	    // get retrieved row
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
	    // set values to object properties
	    $this->model_name = $row['model_name'];
	    $this->color = $row['color'];
	    $this->manufacturer_name = $row['manufacturer_name'];
	    $this->manufacturing_year = $row['manufacturing_year'];
	    $this->registration_number = $row['registration_number'];
	    $this->note = $row['note'];
	    $this->image_1 = $row['image_1']; 	// Modify here to send image url
	    $this->image_2 = $row['image_2'];	// Modify here to send image url
	    $this->is_sold = $row['is_sold'];
	}

	function sell(){
		// select all query
	    $query = "UPDATE ". $this->table_name . " 
	    		  SET is_sold= :is_sold 
	    		  WHERE id=:id";

		// prepare query statement
    	$stmt = $this->conn->prepare($query);

	    // sanitize
	    $this->is_sold=htmlspecialchars(strip_tags($this->is_sold));
	    $this->id=htmlspecialchars(strip_tags($this->id));
	 
	    // bind new values
	    $stmt->bindParam(':is_sold', $this->is_sold);
	    $stmt->bindParam(':id', $this->id);
	 
	    // execute the query
	    if($stmt->execute()){
	        return true;
	    }
	 
	    return false;
	}
}

?>