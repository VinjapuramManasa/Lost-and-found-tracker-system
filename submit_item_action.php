<?php
session_start();
include 'db.php'; // Include your database connection file

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $user_contact = $_POST['user_contact'];
    $user_id = $_SESSION['user_id'];

    // Handle image upload if necessary
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/"; // Directory where images will be uploaded

        // Check if the uploads directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true); // Create the directory if it does not exist
        }

        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file type (optional)
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_path = $target_file; // Store the path to the uploaded image
            } else {
                echo "Error uploading image.";
            }
        } else {
            echo "Only JPG, JPEG, PNG & GIF files are allowed.";
        }
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO items (user_id, type, description, location, user_contact, image_path) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $type, $description, $location, $user_contact, $image_path);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Item submitted successfully. <a href='collected_items.php'>View Collected Items</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Lost/Found Item</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            box-sizing: border-box;
        }

        /* Container for the form */
        .form-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 600px;
            text-align: center;
            transition: all 0.3s ease-in-out;
        }

        .form-container:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }

        h1 {
            color: #333;
            font-size: 36px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        label {
            display: block;
            color: #333;
            font-size: 16px;
            margin-bottom: 8px;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #4CAF50;
            outline: none;
        }

        textarea {
            height: 150px;
            resize: none;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            font-size: 18px;
            padding: 15px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-footer {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .form-footer a {
            color: #007BFF;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        /* Mobile responsive design */
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }

            h1 {
                font-size: 28px;
            }

            input, select, textarea {
                font-size: 14px;
            }

            input[type="submit"] {
                font-size: 16px;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Submit Lost/Found Item</h1>
        <form action="submit_item_action.php" method="POST" enctype="multipart/form-data">
            <label for="type">Type:</label>
            <select name="type" required>
                <option value="lost">Lost</option>
                <option value="found">Found</option>
            </select><br>
            
            <label for="description">Description:</label>
            <textarea name="description" required></textarea><br>
            
            <label for="location">Location:</label>
            <input type="text" name="location" required><br>
            
            <label for="user_contact">Your Contact:</label>
            <input type="text" name="user_contact" required><br>
            
            <label for="image">Upload Image:</label>
            <input type="file" name="image"><br>

            
            <input type="submit" value="Submit Item">
        </form>
        <div class="form-footer">
            <p>Need help? <a href="contact.php">Contact us</a></p>
        </div>
    </div>
</body>
</html>
