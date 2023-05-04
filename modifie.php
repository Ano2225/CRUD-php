<?php
session_start();

include("config.php");



// Récupération des catégories depuis la BD
$sql = "SELECT DISTINCT * FROM categorie";
$query = $conn->prepare($sql);
$query->execute();
$produits = $query->fetchAll();


if (isset($_GET['id'])){
    $produit_id = $_GET['id'];

    // Vérifier que la variable $produit_id est définie
    if (!empty($produit_id)) {

        $query = "SELECT * FROM produit WHERE id_produit=:prod_id";
        $statement = $conn->prepare($query);
        $data = [':prod_id' => $produit_id];
        $statement->execute($data);
        $result = $statement->fetchAll();
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
        <h1>Modifier article</h1>
        <?php foreach ($result as $key) { ?>

        <form action="update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="produit_id" value="<?php echo $key['id_produit']; ?>">
            <div class="row mb-3">
                <label for="name">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name"  value="<?php echo $key['nom_produit']; ?>">
                </div>
            </div>
            <div class="row mb-3">
            <label for="img_produit" class="col-sm-3 col-form-label">Image du produit</label>
            <div class="col-sm-6">
                <div class="col">
                <input type="file" class="form-control" name="img_produit" class="form-control"> <br>
                <input type="hidden" name="image_old" value="<?php echo $key['image_produit'] ?>">
                <img src="<?php echo $key['image_produit']; ?>"  width="100"  >
                </div>
            </div>
            </div>
                <div class="col-sm-6">
                <select name="categorie">
                    <?php foreach ($produits as $produit) { ?>
                        <option value="<?php echo $produit['id_categorie'] ?>"><?php echo $produit['libele_categorie'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="row mb-3">
                <label for="name">Prix</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prix" value="<?php echo $key['prix_produit'] ?>" >
                </div>
            </div>
            <div class="row mb-3">
                <label for="name">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $key['descrip_produit'] ?>">
            </div> <br> <br> <br>
            <div class="row mb-3">
          <?php  

         } ?>
                
                <div class="col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="update_btn">Enregistrer</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="addDeleteModifyUser.php" class="btn btn-primary" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
