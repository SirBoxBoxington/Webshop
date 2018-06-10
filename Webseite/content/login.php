<script src="js/checkLogin.js"></script>
<div class="container">
    <h1>Login</h1>
    <form method="post" action="php/LoginHelper.php" onSubmit="return checkLoginData()">
        <div class="form-group">
            <label for="username">Benutzername</label>
            <input type="text" class="form-control" placeholder="Benutzername eingeben" name="login_usr" id="login_usr">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" placeholder="Passwort eingeben" name="login_pwd" id="login_pw">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="login_remember">
            <label class="form-check-label" for="remember"> Eingeloggt bleiben</label>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="login">Einloggen</button>
        </div>
        <div class="form-group">
            <label for="register">Neuer Kunde? Hier druecken zum registrieren</label>
        </div>
        <div class="form-group">
            <a class="btn btn-primary" id="login" href="?navigate=register">Registrieren</a>
        </div>
    </form>
</div>