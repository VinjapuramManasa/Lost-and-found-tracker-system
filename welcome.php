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
    <title>Welcome</title>
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

        /* Container for the main content */
        .container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 600px;
            text-align: center;
            transition: all 0.3s ease-in-out;
        }

        .container:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }

        h1 {
            color: #333;
            font-size: 38px;
            margin-bottom: 20px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        p {
            color: #555;
            font-size: 18px;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        /* Links styling */
        a {
            text-decoration: none;
            font-size: 16px;
            color: #007BFF;
            display: inline-block;
            margin: 12px 0;
            padding: 12px 20px;
            border-radius: 6px;
            border: 2px solid #007BFF;
            transition: background-color 0.3s, color 0.3s, border 0.3s;
        }

        a:hover {
            background-color: #007BFF;
            color: #ffffff;
            border-color: #0056b3;
        }

        .logout-link {
            color: #d9534f;
            border-color: #d9534f;
        }

        .logout-link:hover {
            background-color: #d9534f;
            color: #ffffff;
            border-color: #c9302c;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 32px;
            }

            p {
                font-size: 16px;
            }

            a {
                font-size: 14px;
                padding: 10px 16px;
            }
        }

        /* Button-like link for "Submit Lost/Found Item" */
        .submit-item-btn {
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }

        .submit-item-btn:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        /* Collected Items link button */
        .view-collected-btn {
            background-color: #17a2b8;
            color: white;
            font-weight: bold;
        }

        .view-collected-btn:hover {
            background-color: #138496;
            border-color: #117a8b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome!</h1>
        <p>You are logged in.</p>
        <a href="submit_item.php" class="submit-item-btn">Submit Lost/Found Item</a><br>
        <a href="collected_items.php" class="view-collected-btn">View Collected Items</a><br>
        <a href="logout.php" class="logout-link">Logout</a>
    </div>
</body>
</html>
