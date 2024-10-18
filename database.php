<?php 
class   Database{

    private $db_host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "testing_oop";
    
    private $mysqli = '';
    private $result = array();
    private $conn = false;

    public function __construct(){
        if(!$this->conn){
            $this->mysqli = new mysqli($this->db_host, $this->username, $this->password, $this->db_name);
            $this->conn = true;
            if($this->mysqli->connect_error){
                array_push($this->result, $this->mysqli->connect_error);
                // return false;    // optional
            }
        }else{
            // return true;     // optional
        }
    }

    // Function to insert into the database
    public function insert($table, $param=array()){
        if($this->tableExists($table)){
           
            $table_colums = implode(', ', array_keys($param)); //implode() ফাংশন একটি স্ট্রিং রিটার্ন করে যা অ্যারের সমস্ত উপাদানগুলির সমন্বয়ে গঠিত।
            $table_value = implode("', '", $param);

            $sql = "INSERT INTO $table ($table_colums) VALUES ('$table_value')";

            if($this->mysqli->query($sql)){
                array_push($this->result, $this->mysqli->insert_id);
                return true;
            }else{
                array_push($this->result, $this->mysqli->error);
                return false;
            }

        }else{
            return false; // optional
        }
    }

    // Function to update row in database
    public function update($table, $param=array(), $where=null){
        if($this->tableExists($table)){

            $args = array();
            foreach($param as $key => $value){
                $args[] = "$key = '$value'";
            }

            $sql = "UPDATE $table SET ". implode(', ', $args);
            // where value check
            if($where != null){
                $sql .= " WHERE $where";
            }
            
            if($this->mysqli->query($sql)){
                array_push($this->result, $this->mysqli->affected_rows);
            }else{
                array_push($this->result, $this->mysqli->error);
            }

        }
    }

    // Function to delete table or row(s) from database
    public function delete($table, $where=null){
        if($this->tableExists($table)){

            $sql = "DELETE FROM $table";
            if($where != null){
                $sql .= " WHERE $where";
            }
            
            if($this->mysqli->query($sql)){
                array_push($this->result, $this->mysqli->affected_rows);
            }else{
                array_push($this->result, $this->mysqli->error);
            }

        }
    }

    // Function to Select from the database
    public function select($table, $row="*", $join=null, $where=null, $order=null, $limit=null){
        if($this->tableExists($table)){
            $sql = "SELECT $row FROM $table";
            
            if($join != null){
                $sql .= " JOIN $join";
            }
            if($where != null){
                $sql .= " WHERE $where";
            }
            if($order != null){
                $sql .= " ORDER BY $order";
            }
            if($limit != null){
                $sql .= " LIMIT 0, $limit";
            }

            echo $sql;

            // query run
            $query = $this->mysqli->query($sql);

            if($query){
                $this->result = $query->fetch_all(MYSQLI_ASSOC);
                return true;
            }else{
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        }
    }

    // only sql pass Function
    public function sql($sql){
        $query = $this->mysqli->query($sql);

        if($query){
            $this->result = $query->fetch_all(MYSQLI_ASSOC);
            return true;
        }else{
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }

    // table ar value exist check 
    private function tableExists($table){
        $sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
        $tableInDb = $this->mysqli->query($sql);

        if($tableInDb){
            if($tableInDb->num_rows == 1){
                return true;
            }else{
                array_push($this->result, $table." does not exist in this Database.");
                return false;
            }
        }
    }

    // Message showing Function
    public function getResult(){
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    // close connection
    public function __destruct(){
        if($this->conn){
            if($this->mysqli->close()){
                $this->conn = false;
                // return true; // optional
            }
        }else{
            // return false;    // optional
        }
    }
}

?>