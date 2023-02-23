<?php 

class database{
    public $mysqli;
    public $query;


    function __construct(){
        $this -> mysqli = new mysqli("localhost","root","","e-document") or die ("Error Connect");
        mysqli_query($this -> mysqli,"SET NAMES utf8");
        date_default_timezone_set("Asia/Bangkok");
    }

    function select($table,$row = "*", $where = null){
        $sql = $where != null ? "SELECT $row FROM $table WHERE $where" : "SELECT $row FROM $table";
        $this -> query = $this -> mysqli -> query($sql);
        return;
    }

    //Update หลักการทำงานคือส่ง table และ parameter มา และทำการแยกระหว่าง key และ value 
    function update($table,$para = [],$id){
        $args = [];
        foreach($para as $key => $value){
            $args[] = "$key = '$value'";
        }

        $sql = "UPDATE $table SET ". implode(",",$args);
        $sql .= " WHERE $id";

        $this -> query = $this -> mysqli -> query($sql);
        return;
    }

    //Insert หลักการทำงานคือส่ง table และ parameter มา และทำการแยกระหว่าง key และ value และมีการใส่ ,  เพื่อคั้น key และ value แต่ละตัว
    function insert($table,$para = []){
        $key = implode(",",array_keys($para));
        $value = implode("','",$para);
        $sql = "INSERT INTO $table ($key) VALUES ('$value')";
        $this -> query = $this -> mysqli -> query($sql);
        return;
    }

    function insertWhere($table,$para = [],$where){
        $key = implode(",",array_keys($para));
        $value = implode("','",$para);
        $sql = "INSERT INTO $table ($key) SELECT '$value' WHERE NOT EXISTS $where";

        echo "<script> console.log($sql) </script>";
        $this -> query = $this -> mysqli -> query($sql);
        return;
    }

    //Delete ง่ายๆ คือ จะมีการส่ง table และ  id มา 
    function delete($table,$id){
        $sql = "DELETE FROM $table WHERE $id";
        $this -> query = $this -> mysqli -> query($sql);
        return;
    }


     //SetAlert คือการส่งค่ามาทำแจ้งเตือน
     function setAlert($text,$type){
        $_SESSION["$type"] = "$text";
        return;

    }

    function setAlertScript($text){
        $_SESSION['error'] = "$text";
        return;
    } 

    function uploadFile($file){
        $allow = array("pdf","docs","png","jpeg","jpg");
        $ext = explode(".",$file['name']);
        $fileExt = strtolower(end($ext));
        $fileNew = rand().".".$fileExt;
    
        $filePath = "./../../file/".$fileNew;
    
        move_uploaded_file($file['tmp_name'],$filePath);
        return $fileNew;
        
    }

    
    //SecureCheck 
    function secureCheck(){
        if(!isset($_SESSION['userid'])){
            header('location:./../../index.php');
            return;
        }else{
            return;
        }
    }

    //Check Admin
    function checkAdmin(){
        if($_SESSION['type'] != 'admin'){
            header('location:./../../index.php');
            return;
        }else{
            return;
        }
        
    }
}
?>