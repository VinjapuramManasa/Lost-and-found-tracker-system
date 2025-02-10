<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Item</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #0000FF;
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

        /* Responsive design for smaller screens */
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

	    <label for="description">Color/Type/Size:</label>
            <textarea name="description" required></textarea><br>
            
            
            <input type="submit" value="Submit Item">
        </form>
        <div class="form-footer">
            <p>Need help? <a href="contact.php">Contact us</a></p>
        </div>
    </div>
</body>
</html>
