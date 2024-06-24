<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
</head>
<body>
    <h1>Todo List</h1>
    <form action="index.php?action=create" method="POST">
        <input type="text" name="task" placeholder="Enter a new task">
        <button type="submit">Add Task</button>
    </form>
    <ul>
        <?php foreach($todos as $todo): ?>
            <li><?php echo htmlspecialchars($todo['task']); ?></li>
        <?php endforeach; ?>
    </ul>
    <form action="login.php?action=logout" method="POST">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
