<?php
class customer{

private $servername= "localhost";
private $username= "root";
private $password= "";
private $database ="crud1";
public $con;


function _construct(){

$this->con=new mysqli($this->servername ,$this->username, $this->password, $this->database);
if(mysqli_connect_error())  {
    echo "connection error ". mysqli_connect_error;
}else {
    return $this->con;
}

}
function insertData($post) 
{
$name = $this->con->real_escape_string($_POST['name']);
$email = $this->con->real_escape_string($_POST['email']);
$username = $this->con->real_escape_string($_POST['username']);
$password = $this->con->real_escape_string($_POST['password']);
$query= "INSERT INTO customers(name,email,username,password) VALUES('$name','$email','$username','$password')";
$sql=$this->con->query($query);
if($sql==true) {
    header("Location:index.php?msg1=insert");
}else {
    echo "Registeration Failed Try again";
}
}
      function displyData()
{
    $query="SELECT * FROM customers";
    $result= $this->con->query($query);
    if($result->num_rows > 0){
        $data= array();
        while ($row=$result->fetch_assoc()) {
            $data[]=$row;
        }
        return $data;
    }else{
        echo "No Record";
    }
}
function displyaRecordById($id) {
    $query= "SELECT * FROM  customers WHERE id='$id'";
    $result= $this->con->query($query);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc(); 
            return $row;
        
    }else {
        echo "no Record Found";
    }
}
  function  updateRecord($postData) {
      $name= $this->con->real_escape_string($_POST['uname']);
      $email= $this->con->real_escape_string($_POST['uemail']);
      $username= $this->con->real_escape_string($_POST['upname']);
      $id = $this->con->real_escape_string($_POST['id']);
      if(!empty($id) && !empty($postData)) 
      {
          $query="UPDATE customers SET name='$name', email='$email',username='$username' WHERE id='$id'";
          $sql=$this->con->query($query);
          if($sql==true) 
          {
              header("Location:index.php?msg2=update");
          }else {
              echo "Registeration update failed try again!";
          }
      }
    }
     function deleteRecord($id) {
     $query="DELETE FROM customers WHERE id='$id'";
     $sql=$this->con->query($query);
     if($sql==true) {
         header("Location:index.php?msg3=delete");
     }else {
         echo "Record does not delete try again";
     }
     }

}



?>