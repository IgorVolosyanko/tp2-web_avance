<?php

class CRUD extends PDO {
    public function __construct(){        
         try {
            parent::__construct('mysql:host=localhost; dbname=bibliotheque; port=8889; charset=utf8', 'root', 'root');

            // Définir le mode d'erreur pour afficher les exceptions
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }        
    }
    
    public function selectAll($table, $field = 'id', $order = 'ASC'){
        $sql = "SELECT * FROM $table ORDER BY $field $order";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }   

    public function select($table, $select, $value, $field = 'id'){
        $sql = "SELECT $select FROM $table WHERE $field = :$field";
        $stmt = $this->prepare($sql);  
        $stmt->bindValue(":$field", $value);        
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function selectId($table, $value, $field = 'nom'){
        $sql = "SELECT (id) FROM $table WHERE $field = :$field";    
        $stmt = $this->prepare($sql);        
        $stmt->bindValue(":$field", $value);        
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 1){
            return $stmt->fetch();
        }else{
            return false;
        }    
    }

    public function insert($table, $data){               
        $fieldName = implode(', ', array_map(fn($k) => "`$k`", array_keys($data)));        
        $fieldValue = ":".implode(', :', array_keys($data));        
        $sql = "INSERT INTO $table ($fieldName) VALUES ($fieldValue)";               
        $stmt = $this->prepare($sql);        
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);            
        }        
        $stmt->execute();
        return $this->lastInsertId();
    }
     
    public function update($table, $data, $field = 'id'){
        $fieldName = null;
        foreach($data as $key=>$value){
            $fieldName .= "$key = :$key, ";
        }         
        $fieldName = rtrim($fieldName, ', ');
        $sql = "UPDATE $table SET  $fieldName WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        if($stmt){
            return true;
        }else{
            return false;
        }
    }

    public function delete($table, $value, $field = 'id'){       
        $sql = "DELETE FROM $table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue("$field", $value);
        $stmt->execute();
        if($stmt){
            return true;
        }else{
            return false;
        }
    }
}
?>