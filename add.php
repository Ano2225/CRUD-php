<?php
session_start();
include("./config.php");

// Récupération des catégories depuis la BD
$sql = "SELECT DISTINCT * FROM categorie";
$query = $conn->prepare($sql);
$query->execute();
$produits = $query->fetchAll();


if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $prix = $_POST['prix'];
    $descrip = $_POST['description_produit'];
    $img_produit = $_FILES['img_produit']['name'];
    $id_categorie = $_POST['categorie'];
    move_uploaded_file( $_FILES['img_produit']['tmp_name'], $_FILES['img_produit']['name']);

    //Ajouter dans table produits
    $sql = "INSERT INTO `produit`(`image_produit`, `nom_produit`, `prix_produit`, `descrip_produit`, `id_categorie`, `id_user`) VALUES (?,?,?,?,?,?)";
    $query = $conn->prepare($sql);
    $query_add = $query->execute([$img_produit, $name, $prix, $descrip, $id_categorie, 1]);
    
    if ($query_add) {
        $_SESSION['message'] = "Ajout effectué avec succès !";
        header("Location: addDeleteModifyUser.php");
        exit();

    }else {
        $_SESSION['message'] = "Ajout annulé ";
        header("Location: addDeleteModifyUser.php");
        exit();
    }
}






?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


    <title>IDOR</title>
</head>
<body>
<div class="container my-5">
    <h1>Nouveau produit</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <label for="name" class="col-sm-3 col-form-label">Nom</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" id="name">
            </div>
        </div>
        <div class="row mb-3">
            <label for="img_produit" class="col-sm-3 col-form-label">Image du produit</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" name="img_produit" id="img_produit">
            </div>
        </div>
       
        <div class="row mb-3">
            <label for="prix" class="col-sm-3 col-form-label">Prix</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="prix" id="prix" step="0.01" min="0">
            </div>
        </div>
        <div class="row mb-3">
    <label for="prix" class="col-sm-3 col-form-label">Categorie</label>
    <div class="col-sm-6">
        <select name="categorie">
            <?php foreach ($produits as $produit) { ?>
                <option value="<?php echo $produit['id_categorie'] ?>"><?php echo $produit['libele_categorie'] ?></option>
            <?php } ?>
        </select>
    </div>
</div>

        <div class="row mb-3">
            <label for="description" class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-6">
                <textarea class="form-control" name="description_produit" id="description" rows="4"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary" name="submit">Enregistrer</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a href="addDeleteModifyUser.php" class="btn btn-primary" role="button">Annuler</a>
            </div>
        </div>
    </form>
</div>

</body>
</html>