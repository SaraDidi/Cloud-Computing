
<div style="margin-top: 100px; text-align: center;">
    <h1>Welcome to University Housing</h1>
    <p>Manage your housing and complaints efficiently.</p>
</div>

<div style="margin: 40px auto 20px auto; max-width: 400px; padding: 15px; border: 1px solid #ccc; border-radius: 5px;">
    <h2>Student Registration</h2>
    <form action="../controllers/register_logic.php" method="POST">

      <div style="margin-bottom: 15px;">
            <label for="name" style="display: block; font-weight: bold;">Name <span style="color: red;">*</span></label>
            
            <input type="name" name="name" id="name" required 
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" />
        </div>
        <div style="margin-bottom: 15px;">
            <label for="matricul" style="display: block; font-weight: bold;">Matricul <span style="color: red;">*</span></label>
            <input type="matricul" name="matricul" id="matricul" required 
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" />
        </div>

        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; font-weight: bold;">Email</label>
            <input type="email" name="email" id="email"  
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" />
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; font-weight: bold;">Password <span style="color: red;">*</span></label>
            <input type="password" name="password" id="password" required 
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" />
        </div>

        <div style="margin-bottom: 15px;">
            <label for="confirm_password" style="display: block; font-weight: bold;">Confirm Password <span style="color: red;">*</span></label>
            <input type="password" name="confirm_password" id="confirm_password" required 
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" />
        </div>


        <button type="submit" style="width: 100%; padding: 10px; background-color: #007BFF; color: white; border: none; border-radius: 5px;">Register</button>
    </form>
    <p style="margin-top: 10px; text-align: center;">
        If you aleady have an account 
        <a href="../index.php" style="color: #007BFF; text-decoration: none;">Sign in</a>
    </p>
</div>





<?php include('../includes/footer.php'); ?>
