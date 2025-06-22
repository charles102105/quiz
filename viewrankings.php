<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "quiz_db";
$conn = mysqli_connect($host, $user, $pass, $db);

$query = "SELECT u.username, r.score, r.date, r.remark 
          FROM results r 
          JOIN users u ON r.user_id = u.id 
          ORDER BY r.score DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(#eeeeee, #d3d3d3);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 60px;
        }
        .results-box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0,0,0,0.2);
            width: 500px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #aaa;
        }
        th {
            background-color: #f1c40f;
            color: black;
        }
        td {
            background-color: #f9f9f9;
        }
        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #7d4caf;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
        .back-button:hover {
            background-color: #a87ed8;
        }
    </style>
</head>
<body>
    <div class="results-box">
        <h2>Leaderboard</h2>
        <table>
            <tr>
                <th>Date</th>
                <th>Username</th>
                <th>Score</th>
                <th>Remark</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['date']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['score']}</td>
                        <td>{$row['remark']}</td>
                      </tr>";
            }
            mysqli_close($conn);
            ?>
        </table>
        <a href="results.php" class="back-button">Back</a>
    </div>
</body>
</html>
