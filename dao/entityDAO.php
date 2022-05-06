<?php
//Source: W12Sample-PHPHPB
//Modified by Minh Hoang Tran
require_once('abstractDAO.php');
require_once('./model/entity.php');

class entityDAO extends abstractDAO {
        
    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }  
    
    public function getEntity($entityId){
        $query = 'SELECT * FROM entities WHERE id = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('i', $entityId);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $temp = $result->fetch_assoc();
            $entity = new entity($temp['id'],$temp['name'], $temp['address'], $temp['salary'],$temp['photoName']);
            $result->free();
            return $entity;
        }
        $result->free();
        return false;
    }


    public function getEntities(){
        //The query method returns a mysqli_result object
        $result = $this->mysqli->query('SELECT * FROM entities');
        $entities = Array();
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                //Create a new entity object, and add it to the array.
                $entity = new entity($row['id'], $row['name'], $row['address'], $row['salary'],$row['photoName']);
                $entities[] = $entity;
            }
            $result->free();
            return $entities;
        }
        $result->free();
        return false;
    }   
    
    public function addEntity($entity){
        
        if(!$this->mysqli->connect_errno){
            //The query uses the question mark (?) as a
            //placeholder for the parameters to be used
            //in the query.
            //The prepare method of the mysqli object returns
            //a mysqli_stmt object. It takes a parameterized 
            //query as a parameter.
			$query = 'INSERT INTO entities (name, address, salary, photoName) VALUES (?,?,?,?)';
			$stmt = $this->mysqli->prepare($query);
            if($stmt){
                    $name = $entity->getName();
			        $address = $entity->getAddress();
			        $salary = $entity->getSalary();
                    $photoName = $entity->getPhotoName(); 
			        $stmt->bind_param('ssis', 
				        $name,
				        $address,
				        $salary,
                        $photoName
			        );    
                    //Execute the statement
                    $stmt->execute();         
                    
                    if($stmt->error){
                        return $stmt->error;
                    } else {
                        return $entity->getName() . ' added successfully!';
                    } 
			}
             else {
                $error = $this->mysqli->errno . ' ' . $this->mysqli->error;
                echo $error; 
                return $error;
            }
       
        }else {
            return 'Could not connect to Database.';
        }
    }   
    public function updateentity($entity){
        
        if(!$this->mysqli->connect_errno){
            //The query uses the question mark (?) as a
            //placeholder for the parameters to be used
            //in the query.
            //The prepare method of the mysqli object returns
            //a mysqli_stmt object. It takes a parameterized 
            //query as a parameter.
            $query = "UPDATE entities SET name=?, address=?, salary=?, photoName =? WHERE id=?";
            $stmt = $this->mysqli->prepare($query);
            if($stmt){
                    $id = $entity->getId();
                    $name = $entity->getName();
			        $address = $entity->getAddress();
			        $salary = $entity->getSalary();
                    $photoName = $entity->getPhotoName();

			        $stmt->bind_param('ssisi', 
				        $name,
				        $address,
				        $salary,
                        $photoName,
                        $id
			        );    
                    //Execute the statement
                    $stmt->execute();         
                    
                    if($stmt->error){
                        return $stmt->error;
                    } else {
                        return $entity->getName() . ' updated successfully!';
                    } 
			}
             else {
                $error = $this->mysqli->errno . ' ' . $this->mysqli->error;
                echo $error; 
                return $error;
            }
       
        }else {
            return 'Could not connect to Database.';
        }
    }   

    public function deleteentity($entityId){
        if(!$this->mysqli->connect_errno){
            $query = 'DELETE FROM entities WHERE id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $entityId);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}
?>

