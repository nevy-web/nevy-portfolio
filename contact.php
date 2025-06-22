<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root"; // Par défaut sous XAMPP
$password = "";     // Par défaut sous XAMPP
$dbname = "utilisateur"; // Remplace par le nom de ta base


echo '<style>
    body { font-family: Arial, sans-serif; background: #f4f4f9; margin: 0; padding: 0; }
    .container { max-width: 500px; margin: 40px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #ccc; padding: 30px; }
    h2 { text-align: center; color: #333; }
    form { display: flex; flex-direction: column; gap: 15px; }
    label { font-weight: bold; color: #555; }
    input[type="text"], input[type="email"], textarea {
        padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;
    }
    textarea { resize: vertical; min-height: 80px; }
    button {
        background: #007bff; color: #fff; border: none; padding: 12px;
        border-radius: 4px; font-size: 16px; cursor: pointer; transition: background 0.2s;
    }
    button:hover { background: #0056b3; }
    .success { color: #28a745; text-align: center; }
    .error { color: #dc3545; text-align: center; }
</style>
<
';

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $conn->real_escape_string($_POST['nom']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);
      $sujet = $conn->real_escape_string($_POST['sujet']);

    $sql = "INSERT INTO users (nom, email, sujet, message) VALUES ('$nom', '$email', '$sujet','$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message envoyé avec succès.";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

echo "nom: $nom<br>";
echo "email: $email<br>";
echo "sujet: $sujet<br>";
echo "message: $message<br>";

$conn->close();
?>
