<?php
$conn = new mysqli("localhost", "root", "", "gestion_etudiants");
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$sql = "SELECT nom, prenom, matricule, numero, filiere, email FROM etudiants";
$result = $conn->query($sql);

echo "<h2>Liste des étudiants inscrits</h2>";
echo "<table border='1' cellpadding='10'>";
echo "<tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Matricule</th>
        <th>Numéro</th>
        <th>Filière</th>
        <th>Email</th>
      </tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["nom"]) . "</td>
                <td>" . htmlspecialchars($row["prenom"]) . "</td>
                <td>" . htmlspecialchars($row["matricule"]) . "</td>
                <td>" . htmlspecialchars($row["numero"]) . "</td>
                <td>" . htmlspecialchars($row["filiere"]) . "</td>
                <td>" . htmlspecialchars($row["email"]) . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>Aucun étudiant inscrit.</td></tr>";
}
echo "</table>";

$conn->close();
?>
