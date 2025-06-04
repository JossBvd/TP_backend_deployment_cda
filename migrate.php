<?php
require 'config.php';

// Connexion sans base pour la créer d'abord
try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Créer la base de données
    $pdo->exec("CREATE DATABASE IF NOT EXISTS podcast_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Base de données 'podcast_db' créée ou déjà existante.\n";

    // Se connecter à la base nouvellement créée
    $pdo->exec("USE jocelyn_td_db");

    // Créer la table
    $sql = "CREATE TABLE IF NOT EXISTS podcasts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        url TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB";

    $pdo->exec($sql);
    echo "Table 'podcasts' créée avec succès ou déjà existante.\n";

} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
