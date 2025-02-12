

<div style="margin-top: 100px; text-align: center;">
    <h1>Bienvenue au service Logements universitaires</h1>
    <p>Gérez efficacement votre logement et vos réclamations.</p>
</div>

<div style="margin: 40px auto 20px auto; max-width: 400px; padding: 15px; border: 1px solid #ccc; border-radius: 5px;">
    <h2>Connexion</h2>
    <form action="controllers/login_logic.php" method="POST">
        <div style="margin-bottom: 15px;">
            <label for="matricul" style="display: block; font-weight: bold;">Matricul</label>
            <input type="matricul" name="matricul" id="matricul" required 
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" />
        </div>
        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; font-weight: bold;">Mot de passe</label>
            <input type="password" name="password" id="password" required 
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" />
        </div>
        <button type="submit" style="width: 100%; padding: 10px; background-color: #007BFF; color: white; border: none; border-radius: 5px;">Login</button>
    </form>
    <p style="margin-top: 10px; text-align: center;">
        Vous n'avez pas de compte? 
        <a href="views/register.php" style="color: #007BFF; text-decoration: none;">Créez-en un</a>.
    </p>
    
</div>

<?php include 'includes/footer.php'; ?>
