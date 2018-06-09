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
		
        ?> <script language="javascript"> alert("con established") </script> <?php

        if ($stmt->execute() === TRUE) 
        {
            echo "Erfolgreich rergistriert.";
            ?> <script language="javascript"> alert("written") </script> <?php
        } 
        else 
        {
            echo '<script language="javascript">alert("Error: "'. $username .'" bereits vergeben.")</script>';
            ?> <script language="javascript"> alert("not written") </script> <?php
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

public function checkLogin()
{
	//If the HTTPS is not found to be "on"
		if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
		{		
			$_COOKIE['page'] = "Home";
			//Tell the browser to redirect to the HTTPS URL.
			header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
			//Prevent the rest of the script from executing.
			exit;
		}
		$this->connect();
		$ldapserver = "ldap.technikum-wien.at";
		$searchbase = "dc=technikum-wien,dc=at";

		$username = (isset($_POST['username']))?$_POST['username']:NULL;
		$passwort = (isset($_POST['passwort']))?$_POST['passwort']:NULL;

		if (!$username)
		{
			// HTML-Formular ausschreiben
			echo "<form action='".$_SERVER['PHP_SELF']."' enctype=\"multipart/form-data\" method='post'>\n";
			echo "<table border=0>\n";
			if(isset($_SESSION['connection_error_un']))
			{
				echo "Username ist falsch.\n";
			}
			if(isset($_SESSION['connection_error_pw']))
			{
				echo "Passwort ist falsch.\n";
			}
			echo "<tr valign='top'><td class=\"login_text\">Benutzer:</td><td>";
			echo "<input type='text' name='username' size=20 value='".$username."'></td></tr>\n";
			echo "<tr valign='top'><td class=\"login_text\">Kennwort:</td><td>";
			echo "<input type='password' name='passwort' size=20 value='".$passwort."'></td></tr>\n";
			echo "<tr valign='top'><td></td><td><input type='submit' name='login' value='Login'></td><td></td></tr>\n";
			echo "<tr valign='top'><td></td><td><input type='submit' formaction='?section=register' name='regist' value='Registrieren'></td><td></td></tr>\n";
			echo "</table>\n</form><br>\n";
            echo "</div>";
            echo "</body>";
            echo "</html>";
		
		} 
		else 
		{
			$Pwd_hash = md5($passwort);
			$_SESSION['username']=$username;
			$this->connect();

			if (mysqli_connect_errno() == 0) 
			{
				$user_einlesen = "SELECT username FROM WTUser WHERE username='$username'";	//count(*) geht nicht
				//$result = $db->query($user_einlesen);
				//$count = $result->num_rows;

				$query = mysqli_query($this->db, $user_einlesen);

				if (!$query)
				{
					die('Error: ' . mysqli_error($this->db));
				}

				if(mysqli_num_rows($query) > 0)
				{
					$pw_einlesen = "SELECT pwd FROM WTUser WHERE username='$username'";
					$query = mysqli_query($this->db, $pw_einlesen);

					while ($qValues=mysqli_fetch_assoc($query))
					{
						if (is_null($qValues["pwd"]))
						{
							unset($_SESSION['noLDAPuser']);
							$username = strtolower($username);
							// LDAP connect
							$ds=ldap_connect($ldapserver);
							if (!$ds) {echo "Connect-Error"; exit;}
							
							// LDAP settings
							ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
							ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

							// LDAP bind
							$ldapbind=false;
							if(ldap_start_tls($ds)) // verschlüsselte Verbindung verwenden
								$dn = "ou=People,".$searchbase;  // wo wird gesucht?
								$ldapbind = @ldap_bind($ds,"uid=".$username.",".$dn,$passwort);
								if ($ldapbind) 
								{
									// LDAP search (Suche am gebundenen Knoten)
									$filter="(uid=$username)";
									$justthese = array("ou", "sn", "givenname"); // nur nach diesen Einträgen suchen
									$sr=ldap_search($ds, $dn, $filter, $justthese); // Suche wird durchgeführt
									$info = ldap_get_entries($ds, $sr);             // gefundene Einträge werden ausgelesen
									$data = $info[0][0];
									$Vorname = $info[0][$data][0];
									$data = $info[0][1];
									$Nachname = $info[0][$data][0];

									$_SESSION['login']=$username;
									$_SESSION['Vorname']=$Vorname;
									$_SESSION['Nachname']=$Nachname;
							
									
								}
								ldap_close($ds);
							
								if(!$ldapbind)
								{	
									$_SESSION['connection_error_pw']=1;
									unset($_SESSION['login']);
									header("Refresh:0");
								}
								else
								{  																		
									echo "<html>";
									echo "<head>";
									echo "<meta name=\"Description\" content=\"\">";
									echo "<meta name=\"Keywords\" content=\"\">";
                                    echo "</head>";
                                    echo "<div class=\"logout-form\">";
									echo "<form action='".$_SERVER['PHP_SELF']."' enctype=\"multipart/form-data\" method='post'>\n";
									echo "<tr valign='top'><td></td><td><input type='submit' name='formaction' value='Logout'></td><td></td></tr>\n";
                                    echo "</table>\n</form><br>\n";
                                    echo "</div>";
									echo "</body>";
									echo "</html>";
									echo "<p class=\"getItRight\">(Connection OK)</p>\n";
									unset($_SESSION['connection_error_un']);
									unset($_SESSION['connection_error_pw']);
								}
						}
						else
						{
							//echo "pwd data=".$qValues["pwd"];
							if($Pwd_hash == $qValues["pwd"])
							{
								$getName = "SELECT vorname, nachname FROM WTUser WHERE username='$username'";
								$query = mysqli_query($this->db, $getName);
								$row = mysqli_fetch_assoc($query);

								$_SESSION['noLDAPuser']=1;
								$_SESSION['login']=$username;
								$_SESSION['Vorname']=$row["vorname"];
								$_SESSION['Nachname']=$row["nachname"];

								
								echo "<html>";
								echo "<head>";
								echo "<meta name=\"Description\" content=\"\">";
								echo "<meta name=\"Keywords\" content=\"\">";
                                echo "</head>";
                                echo "<div class=\"logout-form\">";
								echo "<form action='".$_SERVER['PHP_SELF']."' enctype=\"multipart/form-data\" method='post'>\n";
								echo "<tr valign='top'><td></td><td><input type='submit' name='formaction' value='Logout'></td><td></td></tr>\n";
                                echo "</table>\n</form><br>\n";
                                echo "</div>";
								echo "</body>";
								echo "</html>";
								echo "<p class=\"getItRight\">(Connection OK)</p>\n";
								unset($_SESSION['connection_error_un']);
								unset($_SESSION['connection_error_pw']);
							}
							else
							{
								$_SESSION['connection_error_pw']=1;
								unset($_SESSION['login']);
								header("Refresh:0");
							}
						}
					}		
				}
				else
				{
					// LDAP-Login probieren
					$username = strtolower($username);

					// LDAP connect
					$ds=ldap_connect($ldapserver);
					if (!$ds) {echo "Connect-Error"; exit;}
					
					// LDAP settings
					ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
					ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
					
					// LDAP bind
					$ldapbind=false;
					if(ldap_start_tls($ds)) // verschlüsselte Verbindung verwenden
						$dn = "ou=People,".$searchbase;  // wo wird gesucht?
						$ldapbind = @ldap_bind($ds,"uid=".$username.",".$dn,$passwort);
						if ($ldapbind) 
						{
							// LDAP search (Suche am gebundenen Knoten)
							$filter="(uid=$username)";
							$justthese = array("ou", "sn", "givenname", "mail"); // nur nach diesen Einträgen suchen
							$sr=ldap_search($ds, $dn, $filter, $justthese); // Suche wird durchgeführt
							$info = ldap_get_entries($ds, $sr);             // gefundene Einträge werden ausgelesen
							//echo $info["count"]." entries returned\n<br>";
							$ii=0;
							/*for ($i=0; $ii<$info[$i]["count"]; $ii++){
								$data = $info[$i][$ii];
								echo $data.":  ".$info[$i][$data][0]."\n<br>";
							}*/
							$data = $info[0][0];
							$Vorname = $info[0][$data][0];
							$data = $info[0][1];
							$Nachname = $info[0][$data][0];
							$data = $info[0][3];
							$eMail = $info[0][$data][0];

							$_SESSION['login']=$username;
							$_SESSION['Vorname']=$Vorname;
							$_SESSION['Nachname']=$Nachname;
							$_SESSION['eMail']=$eMail;

							//In Datenbank schreiben
							$sql = "INSERT INTO WTUser (username, vorname, nachname, email, is_admin, is_ldap) VALUES ('$username', '$Vorname', '$Nachname', '$eMail', false, true)";
							if ($db->query($sql) === TRUE) 
							{
								echo "Erfolgreich angemeldet.";
							} 
							else 
							{            
								echo '<script language="javascript">alert("Error: Fehler.")</script>';
							}

						
						}
						ldap_close($ds);

					if(!$ldapbind)
					{	
						$_SESSION['connection_error']=1;
						unset($_SESSION['login']);
						header("Refresh:0");
					}
					else
					{  
						echo "<html>";
						echo "<head>";
						echo "<meta name=\"Description\" content=\"\">";
						echo "<meta name=\"Keywords\" content=\"\">";
                        echo "</head>";
                        echo "<div class=\"logout-form\">";
						echo "<form action='".$_SERVER['PHP_SELF']."' enctype=\"multipart/form-data\" method='post'>\n";
						echo "<tr valign='top'><td></td><td><input type='submit' name='formaction' value='Logout'></td><td></td></tr>\n";
                        echo "</table>\n</form><br>\n";
                        echo "</div>";
						echo "</body>";
						echo "</html>";
						echo "<p class=\"getItRight\">(Connection OK)</p>\n";
						unset($_SESSION['connection_error_un']);
						unset($_SESSION['connection_error_pw']);
					}
				}
			}
    		$this->disconnect(); // Datenbankverbindung schließen
		}
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

		if($stmt = $this->db->prepare("INSERT INTO produkte VALUES (NULL,?,?,?)"))
		{
		$stmt->bind_param("sds",$name, $price, $link);
		
		$price= (isset($_POST['priceReg']))?$_POST['priceReg']:NULL;
		$name= (isset($_POST['productReg']))?$_POST['productReg']:NULL;
		$link = (isset($_POST['linkReg']))?$_POST['linkReg']:NULL;
		
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


}

?>