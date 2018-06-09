

<div class="container">
    <div class="alert alert-warning">
        <strong>Fehler:</strong><?php
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        ?>
	</div>
</div>