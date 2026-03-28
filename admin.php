<?php
// Connect to DB
$conn = new mysqli("localhost", "root", "", "portfolio_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all comments
$sql = "SELECT * FROM comments ORDER BY id DESC";
$result = $conn->query($sql);
?>
<?php
// Handle delete request
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete']; // cast to int for safety
    $conn->query("DELETE FROM comments WHERE id=$id");
    header("Location: admin.php"); // refresh page
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel - Comments</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            padding: 20px;
            background: #0f172a;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #1e293b;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #333;
            text-align: left;
        }

        th {
            background: #38bdf8;
            color: black;
        }

        .delete-btn {
            background: #ff4d4d;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
        }

        .delete-btn:hover {
            background: #ff1a1a;
        }

        .logout-btn {
            background: #e68c0f;
            color: black;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            float: right;
            margin-top: 5px;
            transition: background 0.3s, transform 0.2s;
        }

        .logout-btn:hover {
            background: #60a5fa;
            transform: translateY(-2px);
        }

        h2 {
            display: inline-block;
            margin: 0;
        }
    </style>
</head>

<body>

    <h2>Contact Messages</h2>
    <a href="logout.php" class="logout-btn">Logout</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>

        <?php if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td> <?php echo $row['id']; ?></td>
                    <td> <?php echo htmlspecialchars($row['name']); ?></td>
                    <td> <?php echo htmlspecialchars($row['email']); ?> </td>
                    <td><?php echo htmlspecialchars($row['comment']); ?> </td>
                    <td><?php echo $row['created_at'] ?? ''; ?> </td>
                    <td>
                        <a class="delete-btn" href="?delete=<?php echo $row['id']; ?>"
                            onclick="return confirm('Are you sure to delete this comment?')">Delete</a>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="5">No messages found</td>
            </tr>
        <?php } ?>
    </table>

</body>

</html>