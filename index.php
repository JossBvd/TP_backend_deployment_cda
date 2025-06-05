<?php
require 'config.php';

$podcasts = $pdo->query("SELECT * FROM podcasts ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Podcasts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">🎙️ Podcasts backend</h1>
        <a href="add.php" class="btn btn-success">+ Ajouter un podcast</a>
    </div>

    <?php if (empty($podcasts)): ?>
        <div class="alert alert-info">Aucun podcast disponible.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Titre</th>
                        <th style="width: 300px;">Écouter</th>
                        <th style="width: 160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($podcasts as $podcast): ?>
                        <tr>
                            <td><?= htmlspecialchars($podcast['title']) ?></td>
                            <td>
                                <audio controls preload="none" style="width: 100%;">
                                    <source src="<?= htmlspecialchars($podcast['url']) ?>" type="audio/mpeg">
                                    Votre navigateur ne supporte pas l'audio.
                                </audio>
                            </td>
                            <td class="d-flex flex-column gap-2">
                                <a href="edit.php?id=<?= $podcast['id'] ?>" class="btn btn-outline-primary btn-sm w-100">Modifier</a>
                                <a href="delete.php?id=<?= $podcast['id'] ?>" class="btn btn-outline-danger btn-sm w-100" onclick="return confirm('Supprimer ce podcast ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
