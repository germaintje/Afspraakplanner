    <div class="wrapper">
        <img class="afspraakplanner" src="view/images/afspraakplanner.jpg" alt="Afspraakplanner">
        <h2>Inloggen Beheerder</h2>
        <p>Vul uw gegevens in om in te loggen.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Gebruikersnaam</label>
                <input type="text" name="username" class="form-control" placeholder="JohnDoe" value="" required>
                <span class="help-block"></span>
            </div>    
            <div class="form-group">
                <label>Wachtwoord</label>
                <input type="password" name="password" class="form-control" placeholder="********" value="" required>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>    