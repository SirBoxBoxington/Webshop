<div class="container">
    <h1>Registrierung</h1>
    <form method="post" onsubmit="return validateForm()">
        <div class="form-group">
            <label>Anrede </label>
            <label class="radio-inline"><input type="radio" name="register_gender">Herr</label>
            <label class="radio-inline"><input type="radio" name="register_gender">Frau</label>
        </div>
        <div class="form-group">
            <label>Vorname</label>
            <input type="text" class="form-control" name="register_name">
        </div>
        <div class="form-group">
            <label>Nachname</label>
            <input type="text" class="form-control" name="register_surname">
        </div>
        <div class="form-group">
            <label>Adresse</label>
            <input type="text" class="form-control" name="register_address">
        </div>
        <div class="form-group">
            <label>PLZ</label>
            <input type="number" class="form-control" name="register_postcode">
        </div>
        <div class="form-group">
            <label>Ort</label>
            <input type="text" class="form-control" name="register_city">
        </div>
        <div class="form-group">
            <label>Emailadresse</label>
            <input type="email" class="form-control" name="register_email">
        </div>
        <div class="form-group">
            <label>Benutzername</label>
            <input type="text" class="form-control" name="register_user">
        </div>
        <div class="form-group">
            <label>Passwort</label>
            <input type="password" class="form-control" name="register_password">
        </div>
        <div class="form-group">
            <label>Passwort bestaetigen</label>
            <input type="password" class="form-control" name="register_passwordcopy">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="register">Einloggen</button>
        </div>
    </form>
</div>