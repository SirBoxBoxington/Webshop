<?php
class DB 
{ 
   
public $db;

public function connect()
{
$host     =   "localhost"; 
$user     =   "root";             
$pass     =   '';                   
$dbname   =   "Shop"; 
    $this->db=@new mysqli($host, $user, $pass, $dbname);
}
public function registerUser()
{
	$this->connect();
	
	
	 if (mysqli_connect_errno() == 0) {

		if($stmt = $this->db->prepare("INSERT INTO user VALUES (?,?,?,?,?,?,?,?,?,false,false)"))
		{
		$stmt->bind_param("ssssssiss",$username, $pwd_hash, $vorname, $nachname, $email, $anrede,$plz,$ort,$adresse);
		
		$username = (isset($_POST['usernameReg']))?$_POST['usernameReg']:NULL;
		$pwd_hash = md5((isset($_POST['passwordReg']))?$_POST['passwordReg']:NULL);     
		$vorname = (isset($_POST['vornameReg']))?$_POST['vornameReg']:NULL;
		$nachname = (isset($_POST['nachnameReg']))?$_POST['nachnameReg']:NULL;
		$email = (isset($_POST['emailReg']))?$_POST['emailReg']:NULL;
		$anrede = (isset($_POST['anredeReg']))?$_POST['anredeReg']:NULL;     
		$plz = (isset($_POST['plzReg']))?$_POST['plzReg']:NULL;
		$ort = (isset($_POST['ortReg']))?$_POST['ortReg']:NULL;
		$adresse = (isset($_POST['adresseReg']))?$_POST['adresseReg']:NULL;
		}else
		{
			 $error =$this->db->errno . ' ' . $this->db->error;
			 echo $error;
		}
		
        ?> <script language="javascript"> alert("con established"); </script> <?php

        if ($stmt->execute() === TRUE) 
        {
            echo "Erfolgreich rergistriert.";
            ?> <script language="javascript"> alert("written"); </script> <?php
        } 
        else 
        {
            echo '<script language="javascript">alert("Name already in use")</script>';
            ?> <script language="javascript"> alert("not written"); </script> <?php
        }
    }
    else 
    {
        echo 'Die Datenbank konnte nicht erreicht werden. Folgender Fehler
        trat auf:' .mysqli_connect_errno(). ' : ' .mysqli_connect_error();
        ?> <script language="javascript"> alert("no con") </script> <?php
    }
  $this->disconnect();// Datenbankverbindung schließen
	}

public function disconnect()
{
	if(isset($db))
	{
	$db->close();
	}
}
public function addProduct()
{
	$this->connect();
	if (mysqli_connect_errno() == 0) {

		if($stmt = $this->db->prepare("INSERT INTO produkte VALUES (NULL,?,?,?,?,?)"))
		{
		$stmt->bind_param("sssds",$name, $desc, $kat, $price, $link);
		
		$price= (isset($_POST['priceReg']))?$_POST['priceReg']:NULL;
		$name= (isset($_POST['productReg']))?$_POST['productReg']:NULL;
		$link = (isset($_POST['linkReg']))?$_POST['linkReg']:NULL;
		$kat = (isset($_POST['descReg']))?$_POST['descReg']:NULL;
		$desc= (isset($_POST['katReg']))?$_POST['katReg']:NULL;
		
		}else
		{
			 $error =$this->db->errno . ' ' . $this->db->error;
			 echo $error;
		}
		
        ?> <script language="javascript"> alert("con established") </script> <?php

        if ($stmt->execute() === TRUE) 
        {
            echo "Erfolgreich hinzugefügt";
            ?> <script language="javascript"> alert("written") </script> <?php
        } 
    }
    else 
    {
        echo 'Die Datenbank konnte nicht erreicht werden. Folgender Fehler
        trat auf:' .mysqli_connect_errno(). ' : ' .mysqli_connect_error();
        ?> <script language="javascript"> alert("no con") </script> <?php
    }
  $this->disconnect();// Datenbankverbindung schließen
	}

    public function getRank(){
        //TODO
        return $this->DB_rank;
    }
    public function getUserName(){
        //TODO
        return $this->DB_username;
    }
	public function checkLogin()
	{
		$this->connect();
		if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
     if(mysqli_connect_errno()) {
     printf("Connect failed: %s\n", mysqli_connect_error());
     exit();
    }
      $myusername = mysqli_real_escape_string($this->db,$_POST['login_usr']);
      $mypassword = mysqli_real_escape_string($this->db,$_POST['login_pwd']); 
      $pwdhash= md5($mypassword);
	  
	  
      $sql = "SELECT username FROM User WHERE username = '$myusername' and PW = '$pwdhash'";
	  $rank = "SELECT IsAdmin FROM  User WHERE username = '$myusername' and PW = '$pwdhash'";
      $result = mysqli_query($this->db,$sql);
	  if (!$result) {
    printf("Error: %s\n", mysqli_error($this->db));
    exit();
}
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['name'] = $myusername;
		 if($rank==true)
		 {
         $_SESSION['rank'] = 'admin';
		 }else
		 {
			  $_SESSION['rank'] = 'user';
		 }
		echo "Erfolgreich eingeloggt.";
		$_SESSION['content'] = 'home';
       $referrer = $_SERVER['HTTP_REFERER']; 
		header ("Refresh: 2;URL='$referrer'"); 
		$this->disconnect();
		return true;
      }else {
		echo "Username or Password wrong!";
		$referrer = $_SERVER['HTTP_REFERER']; 
		header ("Refresh: 2;URL='$referrer'"); 
		$this->disconnect();
		return false;
		}
  
		}
		
	}
	public function getProducts()
	{
		$this->connect();
		$returnArray = array();
		$sql = "SELECT * from Produkte";
		if($result = mysqli_query($this->db,$sql))
		{
		
			while ($obj = $result->fetch_object()) {
			$returnArray[] = $obj;
			}
			$result->close();
	print_r($returnArray);
    }
	
		$this->disconnect();
		return $returnArray;
		 
	}
	public function filterProductsByKategorie($kategorie)
	{
		$sql = "SELECT * from Produkte WHERE kategory ='$kategorie'";
			$this->connect();
		$returnArray = array();
		if($result = mysqli_query($this->db,$sql))
		{
		
			while ($obj = $result->fetch_object()) {
			$returnArray[] = $obj;
			}
			$result->close();
	print_r($returnArray);
    }
	
		$this->disconnect();
		return $returnArray;
		 
	}
	public function filterProductsByName($name)
	{
		$sql = "SELECT * from Produkte WHERE name like '%$name%'";
			$this->connect();
		$returnArray = array();
		if($result = mysqli_query($this->db,$sql))
		{
		
			while ($obj = $result->fetch_object()) {
			$returnArray[] = $obj;
			}
			$result->close();
	print_r($returnArray);
    }
	
		$this->disconnect();
		return $returnArray;
		 
	}
	}

}

?>