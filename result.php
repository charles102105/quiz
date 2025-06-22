<?php
ob_start();

session_start();

// Database connection - Update these credentials to match your setup
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password (leave empty "" if no password)
$dbname = "quiz_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (!isset($_SESSION['user']) || $_SESSION['user'] === 'Guest') {
    header("Location: login.php");
    exit();
}

// Get user_id from users table, or create user if doesn't exist
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$_SESSION['user']]);
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user_data) {
    // User doesn't exist, create new user
    try {
        $insert_user = $pdo->prepare("INSERT INTO users (username) VALUES (?)");
        $insert_user->execute([$_SESSION['user']]);
        $user_id = $pdo->lastInsertId();
    } catch(PDOException $e) {
        die("Error creating user: " . $e->getMessage());
    }
} else {
    $user_id = $user_data['id'];
}

$score = 0;
$total_questions = 10;

$q1_correct_answer = 'd';
$q2_correct_answer = 'b';
$q3_correct_answer = 'd';
$q4_correct_answer = 'c';
$q5_correct_answer = 'b';
$q6_correct_answer = 'c';
$q7_correct_answer = 'a';
$q8_correct_answer = 'b';
$q9_correct_answer = 'c';
$q10_correct_answer = 'b';

$q1_question = '1. What is the name of this symbol? (Power Symbol)';
$q2_question = '2. What does CPU stand for?';
$q3_question = '3. What is the name of this part? (RAM Image)';
$q4_question = '4. What is the name of this part? (Hard Drive Image)';
$q5_question = '5. What is the name of a system unit? (Mini Tower Image)';
$q6_question = '6. What does USB stand for?';
$q7_question = '7. JavaScript can be used to build websites?';
$q8_question = '8. HTML is a programming language?';
$q9_question = '9. Which Language is this code snippet written in? print("Hello, World!")';
$q10_question = '10. What is the name of this symbol? (Wi-Fi Symbol)';

$q1_user_answer = $_SESSION['q1'] ?? null;
$q1_status = 'Wrong';
$q1_display_answer = 'Not Answered';
if ($q1_user_answer !== null) {
    if (strtolower($q1_user_answer) == strtolower($q1_correct_answer)) {
        $score++;
        $q1_status = 'Correct';
    }
    switch(strtolower($q1_user_answer)) {
        case 'a': $q1_display_answer = 'A. (Option A Text)'; break;
        case 'b': $q1_display_answer = 'B. (Option B Text)'; break;
        case 'c': $q1_display_answer = 'C. (Option C Text)'; break;
        case 'd': $q1_display_answer = 'D. Gigabyte'; break;
        default: $q1_display_answer = strtoupper($q1_user_answer);
    }
}

$q2_user_answer = $_SESSION['q2'] ?? null;
$q2_status = 'Wrong';
$q2_display_answer = 'Not Answered';
if ($q2_user_answer !== null) {
    if (strtolower($q2_user_answer) == strtolower($q2_correct_answer)) {
        $score++;
        $q2_status = 'Correct';
    }
    switch(strtolower($q2_user_answer)) {
        case 'a': $q2_display_answer = 'A. Computer Personal Unit'; break;
        case 'b': $q2_display_answer = 'B. Central Processing Unit'; break;
        case 'c': $q2_display_answer = 'C. Control Panel Unit'; break;
        case 'd': $q2_display_answer = 'D. Core Processing Unit'; break;
        default: $q2_display_answer = strtoupper($q2_user_answer);
    }
}

$q3_user_answer = $_SESSION['q3'] ?? null;
$q3_status = 'Wrong';
$q3_display_answer = 'Not Answered';
if ($q3_user_answer !== null) {
    if (strtolower($q3_user_answer) == strtolower($q3_correct_answer)) {
        $score++;
        $q3_status = 'Correct';
    }
    switch(strtolower($q3_user_answer)) {
        case 'a': $q3_display_answer = 'A. SSD'; break;
        case 'b': $q3_display_answer = 'B. PSU'; break;
        case 'c': $q3_display_answer = 'C. CPU'; break;
        case 'd': $q3_display_answer = 'D. RAM'; break;
        default: $q3_display_answer = strtoupper($q3_user_answer);
    }
}

$q4_user_answer = $_SESSION['q4'] ?? null;
$q4_status = 'Wrong';
$q4_display_answer = 'Not Answered';
if ($q4_user_answer !== null) {
    if (strtolower($q4_user_answer) == strtolower($q4_correct_answer)) {
        $score++;
        $q4_status = 'Correct';
    }
    switch(strtolower($q4_user_answer)) {
        case 'a': $q4_display_answer = 'A. CPU'; break;
        case 'b': $q4_display_answer = 'B. FAN'; break;
        case 'c': $q4_display_answer = 'C. HARD DRIVE'; break;
        case 'd': $q4_display_answer = 'D. OPTICAL DRIVE'; break;
        default: $q4_display_answer = strtoupper($q4_user_answer);
    }
}

$q5_user_answer = $_SESSION['q5'] ?? null;
$q5_status = 'Wrong';
$q5_display_answer = 'Not Answered';
if ($q5_user_answer !== null) {
    if (strtolower($q5_user_answer) == strtolower($q5_correct_answer)) {
        $score++;
        $q5_status = 'Correct';
    }
    switch(strtolower($q5_user_answer)) {
        case 'a': $q5_display_answer = 'A. Slim Tower'; break;
        case 'b': $q5_display_answer = 'B. Mini Tower'; break;
        case 'c': $q5_display_answer = 'C. Full Tower'; break;
        case 'd': $q5_display_answer = 'D. Small form factor'; break;
        default: $q5_display_answer = strtoupper($q5_user_answer);
    }
}

$q6_user_answer = $_SESSION['q6'] ?? null;
$q6_status = 'Wrong';
$q6_display_answer = 'Not Answered';
if ($q6_user_answer !== null) {
    if (strtolower($q6_user_answer) == strtolower($q6_correct_answer)) {
        $score++;
        $q6_status = 'Correct';
    }
    switch(strtolower($q6_user_answer)) {
        case 'a': $q6_display_answer = 'A. Unique System Board'; break;
        case 'b': $q6_display_answer = 'B. Ultra Storage'; break;
        case 'c': $q6_display_answer = 'C. Universal Serial Bus'; break;
        case 'd': $q6_display_answer = 'D. Universal Series Bus'; break;
        default: $q6_display_answer = strtoupper($q6_user_answer);
    }
}

$q7_user_answer = $_SESSION['q7'] ?? null;
$q7_status = 'Wrong';
$q7_display_answer = 'Not Answered';
if ($q7_user_answer !== null) {
    if (strtolower($q7_user_answer) == strtolower($q7_correct_answer)) {
        $score++;
        $q7_status = 'Correct';
    }
    $q7_display_answer = ($q7_user_answer == 'a' ? 'True' : 'False');
}

$q8_user_answer = $_SESSION['q8'] ?? null;
$q8_status = 'Wrong';
$q8_display_answer = 'Not Answered';
if ($q8_user_answer !== null) {
    if (strtolower($q8_user_answer) == strtolower($q8_correct_answer)) {
        $score++;
        $q8_status = 'Correct';
    }
    $q8_display_answer = ($q8_user_answer == 'a' ? 'True' : 'False');
}

$q9_user_answer = $_SESSION['q9'] ?? null;
$q9_status = 'Wrong';
$q9_display_answer = 'Not Answered';
if ($q9_user_answer !== null) {
    if (strtolower($q9_user_answer) == strtolower($q9_correct_answer)) {
        $score++;
        $q9_status = 'Correct';
    }
    switch(strtolower($q9_user_answer)) {
        case 'a': $q9_display_answer = 'A. Java'; break;
        case 'b': $q9_display_answer = 'B. C++'; break;
        case 'c': $q9_display_answer = 'C. Python'; break;
        case 'd': $q9_display_answer = 'D. PHP'; break;
        default: $q9_display_answer = strtoupper($q9_user_answer);
    }
}

$q10_user_answer = $_SESSION['q10'] ?? null;
$q10_status = 'Wrong';
$q10_display_answer = 'Not Answered';
if ($q10_user_answer !== null) {
    if (strtolower($q10_user_answer) == strtolower($q10_correct_answer)) {
        $score++;
        $q10_status = 'Correct';
    }
    switch(strtolower($q10_user_answer)) {
        case 'a': $q10_display_answer = 'A. Bluetooth Symbol'; break;
        case 'b': $q10_display_answer = 'B. Wi-Fi Symbol'; break;
        case 'c': $q10_display_answer = 'C. Ethernet Symbol'; break;
        case 'd': $q10_display_answer = 'D. Mobile Data Symbol'; break;
        default: $q10_display_answer = strtoupper($q10_user_answer);
    }
}

$passing_score = ceil($total_questions * 0.6);
$result_message_class = ($score >= $passing_score) ? 'passed' : 'failed';
$result_text = ($score === $total_questions) ? 'Perfect 10/10!' : (($score >= $passing_score) ? 'Passed' : 'Failed');

// Determine remark based on score
$remark = '';
if ($score === $total_questions) {
    $remark = 'Perfect Score!';
} elseif ($score >= $passing_score) {
    $remark = 'Passed';
} else {
    $remark = 'Failed';
}

// Save results to database
// First check if user has already taken the quiz (to prevent duplicate entries)
$check_stmt = $pdo->prepare("SELECT id FROM results WHERE user_id = ? ORDER BY date DESC LIMIT 1");
$check_stmt->execute([$user_id]);
$existing_result = $check_stmt->fetch(PDO::FETCH_ASSOC);

try {
    if ($existing_result) {
        // Update existing result
        $update_stmt = $pdo->prepare("UPDATE results SET score = ?, remark = ?, date = CURRENT_TIMESTAMP WHERE id = ?");
        $update_stmt->execute([$score, $remark, $existing_result['id']]);
    } else {
        // Insert new result
        $insert_stmt = $pdo->prepare("INSERT INTO results (user_id, score, remark) VALUES (?, ?, ?)");
        $insert_stmt->execute([$user_id, $score, $remark]);
    }
} catch(PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    // Continue with displaying results even if database save fails
}

// Clear quiz session data after saving
unset($_SESSION['q1'], $_SESSION['q2'], $_SESSION['q3'], $_SESSION['q4'], $_SESSION['q5'], 
      $_SESSION['q6'], $_SESSION['q7'], $_SESSION['q8'], $_SESSION['q9'], $_SESSION['q10']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: rgb(249, 224, 250);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .results-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 650px;
            text-align: center;
            border-top: 5px solid #7d4caf;
            margin-bottom: 20px;
        }

        .user-message {
            color: #333;
            font-size: 1.5em;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .score-display {
            font-size: 2.2em;
            color: #7d4caf;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .result-message {
            font-size: 1.8em;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 8px;
            display: inline-block;
            margin-top: 20px;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .passed {
            background-color: #e8f5e9;
            color: #4CAF50;
            border: 2px solid #4CAF50;
        }

        .failed {
            background-color: #ffebee;
            color: #D32F2F;
            border: 2px solid #D32F2F;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            font-size: 0.95em;
        }

        .results-table th, .results-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .results-table th {
            background-color: #f2f2f2;
            color: #555;
            font-weight: bold;
        }

        .results-table td.correct {
            color: #28a745;
            font-weight: bold;
        }

        .results-table td.wrong {
            color: #dc3545;
            font-weight: bold;
        }

        .logout-button {
            background-color: #7d4caf;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .logout-button:hover {
            background-color: rgb(219, 183, 255);
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
<div class="results-container">
    <div class="success-message">
        Your quiz results have been saved successfully!
    </div>
    
    <div class="user-message">
        <?php
        echo "Welcome, " . htmlspecialchars($_SESSION['user'] ?? 'Guest') . "!";
        ?>
    </div>
    <div class="score-display">Your Score: <?php echo $score; ?> / <?php echo $total_questions; ?></div>
    <div class="result-message <?php echo $result_message_class; ?>"><?php echo $result_text; ?></div>

    <table class="results-table">
        <thead>
            <tr>
                <th>Question</th>
                <th>Your Answer</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo htmlspecialchars($q1_question); ?></td>
                <td class="<?php echo strtolower($q1_status); ?>"><?php echo $q1_display_answer; ?></td>
                <td class="<?php echo strtolower($q1_status); ?>"><?php echo $q1_status; ?></td>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($q2_question); ?></td>
                <td class="<?php echo strtolower($q2_status); ?>"><?php echo $q2_display_answer; ?></td>
                <td class="<?php echo strtolower($q2_status); ?>"><?php echo $q2_status; ?></td>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($q3_question); ?></td>
                <td class="<?php echo strtolower($q3_status); ?>"><?php echo $q3_display_answer; ?></td>
                <td class="<?php echo strtolower($q3_status); ?>"><?php echo $q3_status; ?></td>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($q4_question); ?></td>
                <td class="<?php echo strtolower($q4_status); ?>"><?php echo $q4_display_answer; ?></td>
                <td class="<?php echo strtolower($q4_status); ?>"><?php echo $q4_status; ?></td>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($q5_question); ?></td>
                <td class="<?php echo strtolower($q5_status); ?>"><?php echo $q5_display_answer; ?></td>
                <td class="<?php echo strtolower($q5_status); ?>"><?php echo $q5_status; ?></td>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($q6_question); ?></td>
                <td class="<?php echo strtolower($q6_status); ?>"><?php echo $q6_display_answer; ?></td>
                <td class="<?php echo strtolower($q6_status); ?>"><?php echo $q6_status; ?></td>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($q7_question); ?></td>
                <td class="<?php echo strtolower($q7_status); ?>"><?php echo $q7_display_answer; ?></td>
                <td class="<?php echo strtolower($q7_status); ?>"><?php echo $q7_status; ?></td>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($q8_question); ?></td>
                <td class="<?php echo strtolower($q8_status); ?>"><?php echo $q8_display_answer; ?></td>
                <td class="<?php echo strtolower($q8_status); ?>"><?php echo $q8_status; ?></td>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($q9_question); ?></td>
                <td class="<?php echo strtolower($q9_status); ?>"><?php echo $q9_display_answer; ?></td>
                <td class="<?php echo strtolower($q9_status); ?>"><?php echo $q9_status; ?></td>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($q10_question); ?></td>
                <td class="<?php echo strtolower($q10_status); ?>"><?php echo $q10_display_answer; ?></td>
                <td class="<?php echo strtolower($q10_status); ?>"><?php echo $q10_status; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<div style="display: flex; gap: 10px; justify-content: center; margin-top: 20px;">
    <a href="viewrankings.php" class="logout-button">View Rankings</a>
    <a href="logout.php" class="logout-button">Logout</a>
</div>

</body>
</html>
<?php
ob_end_flush();
?>