<?php
ob_start();
?>
<h1>Ma Todo List</h1>
<a href="/add">Ajouter une nouvelle tâche</a>
<ul>
    <?php foreach ($todos as $todo): ?>
        <li>
            <span
                style="text-decoration: <?= $todo['done'] ? 'line-through' : 'none' ?>"><?= htmlspecialchars($todo['task']); ?></span>
            <div>
                <a href="/toggle?id=<?= $todo['id'] ?>">✅</a>
                <a href="/delete?id=<?= $todo['id'] ?>">❌</a>
                <a href="/update?id=<?= $todo['id'] ?>">📝</a>
            </div>
        </li>
    <?php endforeach ?>
</ul>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php' ?>