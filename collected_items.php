<?php
session_start();
include 'db.php'; // Include your database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit();
}

// Fetch items from the database
$sql = "SELECT items.*, users.username FROM items JOIN users ON items.user_id = users.id ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collected Items</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            box-sizing: border-box;
            padding-top: 30px;
        }

        h1 {
            color: #333;
            font-size: 36px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        a {
            color: #007BFF;
            text-decoration: none;
            font-size: 18px;
            margin: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Table Styling */
        table {
            width: 80%;
            max-width: 1200px;
            margin-top: 30px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            width: 100px;
            height: auto;
            border-radius: 8px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            table {
                width: 95%;
                margin: 10px;
            }

            th, td {
                font-size: 14px;
                padding: 10px;
            }

            img {
                width: 80px;
            }
        }

        /* Footer for no items found */
        .no-items {
            margin-top: 20px;
            font-size: 18px;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>Collected Items</h1>
    <a href="submit_item.php">Submit a New Item</a> | <a href="logout.php">Logout</a>
    
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Type</th>
                <th>Description</th>
                <th>Location</th>
                <th>Contact</th>
                <th>Submitted By</th>
                <th>Image</th>
                <th>Date Submitted</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['type']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo htmlspecialchars($row['location']); ?></td>
                    <td><?php echo htmlspecialchars($row['user_contact']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td>
                        <?php if ($row['image_path']): ?>
                            <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Item Image">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p class="no-items">No items found.</p>
    <?php endif; ?>

    <?php $conn->close(); // Close the database connection ?>
</body>
</html>
