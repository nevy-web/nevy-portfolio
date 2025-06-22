<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "utilisateur";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de connexion: " . $conn->connect_error);
}

// Récupération des messages
$sql = "SELECT nom, email, sujet, message FROM users ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messages reçus</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .message {
            background: white;
            border-left: 5px solid #007bff;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .message h3 {
            margin-top: 0;
            color: #007bff;
        }
        .email {
            color: #555;
        }
    </style>
</head>
<body>

<h1>Messages reçus</h1>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="message">';
        echo '<h3>' . htmlspecialchars($row["sujet"]) . '</h3>';
        echo '<p class="email"><strong>' . htmlspecialchars($row["nom"]) . '</strong> — ' . htmlspecialchars($row["email"]) . '</p>';
        echo '<p>' . nl2br(htmlspecialchars($row["message"])) . '</p>';
        echo '</div>';
    }
} else {
    echo "<p>Aucun message trouvé.</p>";
}
$conn->close();
?>

</body>
</html>