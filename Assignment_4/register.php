<?php
// register.php
// Initialize variables
$fullName = $username = $email = $age = "";
$errors = [];
$success = false;
// Password strength indicator
$passwordStrength = "";
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Full Name
    if (empty($_POST['full_name'])) {
        $errors['full_name'] = "Full Name is required.";
    } else {
        $fullName = trim($_POST['full_name']);
        if (strlen($fullName) < 3) {
            $errors['full_name'] = "Full Name must be at least 3 characters long.";
        } elseif (!preg_match("/^[a-zA-Z ]+$/", $fullName)) {
            $errors['full_name'] = "Full Name can contain only letters and spaces.";
        }
        $fullName = htmlspecialchars($fullName);
    }
    // Username
    if (empty($_POST['username'])) {
        $errors['username'] = "Username is required.";
    } else {
        $username = trim($_POST['username']);
        if (!preg_match("/^[a-zA-Z0-9_]{5,15}$/", $username)) {
            $errors['username'] = "Username must be 5-15 characters, alphanumeric with underscores only.";
        }
        $username = htmlspecialchars($username);
    }

    // Email
    if (empty($_POST['email'])) {
        $errors['email'] = "Email is required.";
    } else {
        $email = trim($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || preg_match("/\s/", $email)) {
            $errors['email'] = "Invalid email format or contains spaces.";
        }
    }

    // Password
    if (empty($_POST['password'])) {
        $errors['password'] = "Password is required.";
    } else {
        $password = $_POST['password'];
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
            $errors['password'] = "Password must be at least 8 characters and include uppercase, lowercase, and number.";
        } else {
            // Password strength
            if (strlen($password) >= 12 && preg_match("/[!@#$%^&*]/", $password)) {
                $passwordStrength = "Strong";
            } elseif (strlen($password) >= 8) {
                $passwordStrength = "Medium";
            } else {
                $passwordStrength = "Weak";
            }
        }
    }

    // Confirm Password
    if (empty($_POST['confirm_password'])) {
        $errors['confirm_password'] = "Confirm Password is required.";
    } elseif ($_POST['confirm_password'] !== $_POST['password']) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    // Age
    if (empty($_POST['age'])) {
        $errors['age'] = "Age is required.";
    } else {
        $age = $_POST['age'];
        if (!is_numeric($age) || $age < 18 || $age > 100) {
            $errors['age'] = "Age must be a number between 18 and 100.";
        }
    }

    // If no errors, mark success
    if (empty($errors)) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Registration Form</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        form { max-width: 500px; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="email"], input[type="password"], input[type="number"] {
            width: 100%; padding: 8px; margin-top: 5px;
        }
        input[type="submit"] { margin-top: 20px; padding: 10px 20px; }
        .error { color: red; font-size: 0.9em; }
        .success { margin-top: 20px; padding: 15px; border: 1px solid green; background-color: #f0fff0; }
        .strength { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Secure Registration Form</h1>

    <form method="post" action="">
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" id="full_name" value="<?php echo $fullName; ?>">
        <?php if(isset($errors['full_name'])) echo "<div class='error'>{$errors['full_name']}</div>"; ?>

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>">
        <?php if(isset($errors['username'])) echo "<div class='error'>{$errors['username']}</div>"; ?>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>">
        <?php if(isset($errors['email'])) echo "<div class='error'>{$errors['email']}</div>"; ?>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <?php if(isset($errors['password'])) echo "<div class='error'>{$errors['password']}</div>"; ?>
        <?php if($passwordStrength) echo "<div class='strength'>Password Strength: $passwordStrength</div>"; ?>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password">
        <?php if(isset($errors['confirm_password'])) echo "<div class='error'>{$errors['confirm_password']}</div>"; ?>

        <label for="age">Age:</label>
        <input type="number" name="age" id="age" value="<?php echo $age; ?>">
        <?php if(isset($errors['age'])) echo "<div class='error'>{$errors['age']}</div>"; ?>
        <input type="submit" value="Register">
    </form>
    <?php if($success): ?>
        <div class="success">
            <h2>Registration Successful!</h2>
            <p><strong>Full Name:</strong> <?php echo $fullName; ?></p>
            <p><strong>Username:</strong> <?php echo $username; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Age:</strong> <?php echo $age; ?></p>
            <p><strong>Password Strength:</strong> <?php echo $passwordStrength; ?></p>
        </div>
    <?php endif; ?>
</body>
</html>
