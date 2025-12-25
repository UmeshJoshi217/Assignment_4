<?php
// profile_upload.php
$errors = [];
$success = false;
$userName = "";
$fileInfo = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate User Name
    if (empty($_POST['user_name'])) {
        $errors[] = "User Name is required.";
    } else {
        $userName = trim($_POST['user_name']);
        if (strlen($userName) < 3) {
            $errors[] = "User Name must be at least 3 characters.";
        }
        $userName = htmlspecialchars($userName);
    }
    // Validate file upload
    if (!isset($_FILES['profile_pic'])) {
        $errors[] = "No file uploaded.";
    } else {
        $file = $_FILES['profile_pic'];
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            switch ($file['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    $errors[] = "File size exceeds 2MB limit.";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $errors[] = "No file uploaded.";
                    break;
                default:
                    $errors[] = "Error uploading file.";
            }
        }

        // Validate file type
        if (!in_array($file['type'], $allowedTypes)) {
            $errors[] = "Invalid file type. Only JPG, JPEG, PNG, GIF allowed.";
        }

        // Validate file size
        if ($file['size'] > $maxSize) {
            $errors[] = "File size exceeds 2MB limit.";
        }
    }

    // Process file if no errors
    if (empty($errors)) {
        $uploadDir = "uploads";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filePath = $uploadDir . "/" . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            $success = true;
            $fileInfo = [
                'name' => $file['name'],
                'size' => round($file['size'] / 1024 / 1024, 2) . " MB",
                'type' => $file['type'],
                'path' => $filePath
            ];
        } else {
            $errors[] = "Failed to save uploaded file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Picture Upload</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        form { max-width: 400px; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="file"] { width: 100%; padding: 8px; margin-top: 5px; }
        input[type="submit"] { margin-top: 20px; padding: 10px 20px; }
        .error { color: red; margin-top: 10px; }
        .success { margin-top: 20px; padding: 15px; border: 1px solid green; background-color: #f0fff0; }
        img { margin-top: 10px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <h1>Profile Picture Upload</h1>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <h3>Upload Errors:</h3>
            <ul>
                <?php foreach($errors as $err): ?>
                    <li><?php echo $err; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="user_name">User Name:</label>
        <input type="text" name="user_name" id="user_name" value="<?php echo $userName; ?>" required>
        <label for="profile_pic">Profile Picture:</label>
        <input type="file" name="profile_pic" id="profile_pic" accept="image/*" required>
        <input type="submit" value="Upload">
    </form>
    <?php if ($success): ?>
        <div class="success">
            <h2>Profile Picture Uploaded Successfully!</h2>
            <p><strong>User Name:</strong> <?php echo $userName; ?></p>
            <h3>File Information:</h3>
            <p><strong>File Name:</strong> <?php echo $fileInfo['name']; ?></p>
            <p><strong>File Size:</strong> <?php echo $fileInfo['size']; ?></p>
            <p><strong>File Type:</strong> <?php echo $fileInfo['type']; ?></p>
            <p><strong>Saved Location:</strong> <?php echo $fileInfo['path']; ?></p>
            <img src="<?php echo $fileInfo['path']; ?>" width="200" alt="Uploaded Image">
        </div>
    <?php endif; ?>
</body>
</html>
