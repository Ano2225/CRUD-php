<?php
session_start();

include 'config.php';
//Mise des elements de la base de donnée 


if (isset($_POST['update_btn'])){
    $produit_id = $_POST['produit_id'];
    $name = $_POST['name'];
    $prix = $_POST['prix'];
    $descrip = $_POST['description'];
    $categorie = $_POST['categorie'];
    $old_image = $_POST['image_old'];
    $new_image = $_FILES['img_produit']['name'];

    if($new_image != ""){
        $update_filename = $new_image;
      
    } else {
        $update_filename = $old_image;
    }



    try {
        $query = "UPDATE produit SET image_produit=:image_produit, nom_produit=:nom_produit,prix_produit=:prix_produit,descrip_produit=:descrip_produit, id_categorie=:id_categorie WHERE id_produit =:prod_id";
        $statement = $conn->prepare($query);
        $data = [
                'image_produit'=>$update_filename,
                'nom_produit'=>$name,
                'prix_produit'=> $prix,
                'descrip_produit'=> $descrip,
                'id_categorie'=> $categorie,
                'prod_id'=> $produit_id
                
        ];

        $query_execute = $statement->execute($data);

        if($query_execute){
            if($_FILES['img_produit']['name'] != ""){
                move_uploaded_file( $_FILES['img_produit']['tmp_name'], $_FILES['img_produit']['name']);
                unlink($old_image);
            }

            $_SESSION['message'] = "Modification effectué avec succès !";
            header('Location:addDeleteModifyUser.php ');
            exit();
        }else {
            $_SESSION['message'] = 'Modification annulée avec succès !';
            header('Location:addDeleteModifyUser.php ');
            exit();
            
        }


    }catch(PDOException $e) {
        echo $e->getMessage();
    }

}









?>