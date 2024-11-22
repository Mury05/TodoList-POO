<?php ob_start(); ?>
<h1>Modifier la tâche</h1>
<form action="/update?id=<?=$todoItem['id']?>" method="post">
    <input type="text" class="todo" name="task" value="<?=$todoItem['task']?>" placeholder="Modifier la tâche" required>
    <button type="submit">Modifier</button>
</form>
<?php $content = ob_get_clean(); ?>

<?php include "layout.php" ?>
