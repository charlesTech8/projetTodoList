<?php 
require_once('../db_conn.php');

if(isset( $_POST['iddelete'] )){
    $id = $_POST['iddelete'];
    if(empty($id)){
        header('Location: ../index.php');
        exit();
    }else{
        $stmt = $conn->prepare("DELETE FROM todos WHERE id = ?");
        $res = $stmt->execute([$id]);
        $stmt->closeCursor();
        header('Location: ../index.php?mess=success');
        exit();
    }
}


if( isset($_POST['title']) ){
    $title = htmlentities( $_POST['title'] );
    $description = htmlentities( $_POST['description']);
    $assigne = htmlentities( $_POST['auteur']);

    if( empty( $title ) || empty( $assigne ) ){
        header('Location: ../index.php?mess=error');
    }else{
        $stmt = $conn->prepare("INSERT INTO todos(title, descrip, auteur,etat) VALUE(?,?,?,?)");
        $res = $stmt->execute([$title, $description, $assigne, 1]);

        if( $res ){
            header('Location: ../index.php?mess=success');
        }else{
            header('Location: ../index.php');
        }
        $stmt->closeCursor();
        exit;
    }
}else{
    header('Location: ../index.php?mess=error');
    exit;
}