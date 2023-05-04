<?php
session_start();
include("config.php");



//Suppression des elements de la base de donnée 
   
if (isset($_POST['delete'])){

    $id = $_POST['id'];

    try {
        $query = "DELETE FROM produit WHERE id_produit=:prod_id";
        $statement = $conn->prepare($query);
        $data = [
            'prod_id' => $id
        ];
        $query_execute =  $statement->execute($data);

        if($query_execute) {
            $_SESSION['message'] = "Suppression effectué avec succès !";
            header('Location:addDeleteModifyUser.php ');
            exit();
            
        }else {
            $_SESSION['message'] = "Suppression non effectué !";
            header('Location:addDeleteModifyUser.php ');
            exit();
        }

    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>