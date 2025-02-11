

<div style="margin-top: 100px; text-align: center;">
    <h1>Welcome to University Housing</h1>
    <p>Manage your housing and complaints efficiently.</p>
</div>

<div style="margin: 40px auto 20px auto; max-width: 400px; padding: 15px; border: 1px solid #ccc; border-radius: 5px;">
    <h2>Login</h2>
    <form action="controllers/login_logic.php" method="POST">
        <div style="margin-bottom: 15px;">
            <label for="matricul" style="display: block; font-weight: bold;">Matricul</label>
            <input type="matricul" name="matricul" id="matricul" required 
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" />
        </div>
        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; font-weight: bold;">Password</label>
            <input type="password" name="password" id="password" required 
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" />
        </div>
        <button type="submit" style="width: 100%; padding: 10px; background-color: #007BFF; color: white; border: none; border-radius: 5px;">Login</button>
    </form>
    <p style="margin-top: 10px; text-align: center;">
        Don't have an account? 
        <a href="views/register.php" style="color: #007BFF; text-decoration: none;">Create one</a>.
    </p>
    
</div>

<?php include 'includes/footer.php'; ?>
