<?php
    $usernameReg = $passwordReg = $passwortRepeat = $vornameReg = $nachnameReg = $emailReg = $plzReg= $ortReg=$anredeReg=$adresseReg="";
	include("datenbankconnection.php");
?>
<div>
    <h2>Please fill in you information</h2>

    <form action="./?section=register" method="post">
        <label for="username">Username</label><br/>
        <input type="text" name="usernameReg" placeholder="Usernamen eingeben" value="<?php echo $usernameReg; ?>"><br/>
        <label for="password">Passwort</label><br/>
        <input type="password" name="passwordReg" placeholder="Passwort eingeben" value="<?php echo $passwordReg; ?>"><br/>
        <label for="password">Passwort wiederholen</label><br/>
		<input type="password" name="passwordRepeat" placeholder="Passwort wiederholen" value="<?php echo $passwortRepeat; ?>"><br/>
		<label for="anrede">Anrede</label><br/>
        <input type="text" name="anredeReg" placeholder="Anrede eingeben" value="<?php echo $anredeReg; ?>"><br/>
        <label for="vorname">Vorname</label><br/>
        <input type="text" name="vornameReg" placeholder="Vornamen eingeben" value="<?php echo $vornameReg; ?>"><br/>
        <label for="nachname">Nachname</label><br/>
        <input type="text" name="nachnameReg" placeholder="Nachname eingeben" value="<?php echo $nachnameReg; ?>"><br/>
        <label for="email">Email</label><br/>
        <input type="text" name="emailReg" placeholder="Email eingeben" value="<?php echo $emailReg; ?>"><br/>
		<label for="PLZ">PLZ</label><br/>
        <input type="number" name="plzReg" placeholder="PLZ eingeben" value="<?php echo $plzReg; ?>"><br/>
        <label for="ort">Ort</label><br/>
        <input type="text" name="ortReg" placeholder="Ort eingeben" value="<?php echo $ortReg; ?>"><br/>
		<label for="adresse">Adresse</label><br/>
        <input type="text" name="adresseReg" placeholder="Adresse eingeben" value="<?php echo $adresseReg; ?>"><br/>
		
        
        <button type="submit">Sign up</button>
    </form>
</div>