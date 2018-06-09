<div class="container">
    <h1>Login</h1>
    <form method="post">
        <div class="form-group">
            <label for="username">Benutzername</label>
            <input type="text" class="form-control" id="username" placeholder="Benutzername eingeben">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Passwort eingeben">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember"> Eingeloggt bleiben</label>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Einloggen</button>
        </div>
        <div class="form-group">
            <label for="register">Neuer Kunde? Hier druecken zum registrieren</label>
        </div>
        <div class="form-group">
            <a class="btn btn-primary" id="register" href="?navigate=register">Registrieren</a>
        </div>
    </form>
</div>