<?php
namespace Model;
use \PDO;

class BaseModel
{
    private $pdo;
    private $id;
    
    public function getId() {
        return $this->id;
    }
 
    public function setId($id) {
        $this->id = $id;
    }
    
	private function openConnection(){		
		try{
			$this->pdo = new PDO('mysql:host='.HOSTNAME_DATABASE.';dbname='.NAME_DATABASE.';charset=utf8', USERNAME_DATABASE, PASSWORD_DATABASE);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	private function closeConnection(){
		$this->pdo =  null;
	}

	public function execSql($sql,$parameters, $list = false, $obtainId = false){
		
		try	{
			$this->openConnection();		
			$stm = $this->pdo->prepare($sql);
			$stm->execute($parameters);
			if($obtainId){
				$result = $this->pdo->lastInsertId();
			} else {
				$result = ($list)? $stm->fetchAll(PDO::FETCH_OBJ) : $stm->fetch(PDO::FETCH_OBJ);		
			}
			$this->closeConnection();
			
		}catch(Exception $e){
			die($e->getMessage());
		}
		return $result;
	}	
}
