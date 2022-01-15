<?php
require_once('db_conn.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $todos = $conn->query("SELECT * FROM todos WHERE id ='$id'");
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>To-Do List</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div class="main-section">
            <a href="index.php" style="color: white; font-size:20px;">Accueil</a>
            <?php if ($todos->rowCount() <= 0) {
            ?>
                <div class="todo-item">
                    <div class="empty">
                        <p style="color: blueviolet;">N'EXISTE PAS</p>
                    </div>
                </div>
                <?php
            } else {
                while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <div class="show-todo-section">
                        <div class="todo-item">
                            <form method="POST" action="">
                                <input type="hidden" name="iddelete" value="">
                                <button type="submit" class="remove-to-do">x</button>
                            </form>
                            <h2><?= $todo['title'] ?></h2>
                            <hr>
                            <h3>Description</h3>
                            <p style="padding-left: 20px;">
                            <?= $todo['descrip'] ?>
                            </p>
                            <small style="border-top: 2px solid black;">Assigné à : <strong> <?= $todo['auteur'] ?></strong> // Crée: <?= $todo['date_time'] ?> </small>
                        </div>
                    </div>
                    <div class="add-section">
                        <form action="modele/add.php" method="POST">
                            <input type="text" name="title1" value="<?= $todo['title'] ?>" />
                            <textarea name="description1" rows="2" placeholder=""><?= $todo['descrip'] ?></textarea>
                            <input type="auteur" name="auteur1" value="<?= $todo['auteur'] ?>" />
                            <input type="hidden" name="id" value="<?= $todo['id'] ?>">
                            <button type="submit">Update</button>
                        </form>
                    </div>
            <?php
                }
            }

            ?>
        </div>
    </body>

    </html>
<?php
} else {
    header('Location: index.php');
    exit;
}
?>