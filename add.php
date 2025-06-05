<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $url = $_POST['url'];

    $stmt = $pdo->prepare("INSERT INTO podcasts (title, url) VALUES (?, ?)");
    $stmt->execute([$title, $url]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Ajouter un Podcast</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<div class="container py-5" style="max-width: 600px;">
    <h1 class="mb-4 text-primary">Ajouter un Podcast</h1>
    <form method="post" novalidate>
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" required placeholder="Titre du podcast">
        </div>
        <div class="mb-4">
            <label for="url" class="form-label">URL du fichier audio</label>
            <input type="url" class="form-control" id="url" name="url" required placeholder="https://exemple.com/podcast.mp3">
        </div>
        <button type="submit" class="btn btn-success w-100">Ajouter</button>
        <a href="index.php" class="btn btn-secondary w-100 mt-2">Annuler</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
