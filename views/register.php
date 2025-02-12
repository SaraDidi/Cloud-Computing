
<div style="margin-top: 100px; text-align: center;">
    <h1>Bienvenue au service Logements universitaires</h1>
    <p>Gérez efficacement votre logement et vos réclamations.</p>
</div>

<div style="margin: 40px auto 20px auto; max-width: 400px; padding: 15px; border: 1px solid #ccc; border-radius: 5px;">
    <h2>Inscription des étudiants</h2>
    <form action="../controllers/register_logic.php" method="POST">

      <div style="margin-bottom: 15px;">
            <label for="name" style="display: block; font-weight: bold;">Nom <span style="color: red;">*</span></label>
            
            <input type="name" name="name" id="name" required 
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" />
        </div>
        <div style="margin-bottom: 15px;">
            <label for="matricul" style="display: block; font-weight: bold;">Matricul <span style="color: red;">*</span></label>
            <input type="matricul" name="matricul" id="matricul" required 
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" />
        </div>

        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; font-weight: bold;">E-mail</label>
            <input type="email" name="email" id="email"  
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" />
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; font-weight: bold;">Mot de passe <span style="color: red;">*</span></label>
            <input type="password" name="password" id="password" required 
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" />
        </div>

        <div style="margin-bottom: 15px;">
            <label for="confirm_password" style="display: block; font-weight: bold;">Confirmez le mot de passe <span style="color: red;">*</span></label>
            <input type="password" name="confirm_password" id="confirm_password" required 
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" />
        </div>


        <button type="submit" style="width: 100%; padding: 10px; background-color: #007BFF; color: white; border: none; border-radius: 5px;">Registre</button>
    </form>
    <p style="margin-top: 10px; text-align: center;">
         Si vous avez déjà un compte ? 
        <a href="../index.php" style="color: #007BFF; text-decoration: none;">Connectez-vous</a>
    </p>
</div>





<?php include('../includes/footer.php'); ?>
