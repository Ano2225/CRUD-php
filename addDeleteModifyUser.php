<?php
session_start();

$utilisateur_connecte = 1;

include("./config.php");

$sql = "SELECT produit.*, categorie.libele_categorie 
        FROM produit 
        JOIN categorie ON produit.id_categorie = categorie.id_categorie 
        WHERE produit.id_user = :utilisateur_id";
$query = $conn->prepare($sql);
$query->execute(['utilisateur_id' => $utilisateur_connecte]);
$produits = $query->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


    <title>Liste des produits</title>
</head>
<body>
    <div class="container my-5">
    <?php if(isset($_SESSION['message']) && $_SESSION != '') : ?>
  <h5 class="alert alert-success"><?= $_SESSION['message'] ?>   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</h5>
  <?php unset($_SESSION['message']); ?>
<?php endif; ?>


        <h2>Liste des produits</h2>
        <a href="./add.php" class="btn btn-primary" role="button">Nouveau produit</a>
        <br>
     
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Image</th>
                    <th>Prix</th>
                    <th>Description</th>
                    <th>Catégorie</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $produit) { ?>
                <tr>
                    <td><?php echo $produit['nom_produit'] ?></td>
                    <td><img src="<?php echo $produit['image_produit'] ?>" alt="" width="30%"></td>
                    <td><?php echo $produit['prix_produit'] ?> f</td>
                    <td><?php echo $produit['descrip_produit'] ?></td>
                    <td><?php echo $produit['libele_categorie'] ?></td>
                    <td>
                        <a href="./modifie.php?id=<?php echo $produit['id_produit'];?>" class="btn btn-primary btn-sm">Modifier</a> <br><br>
                    </td>
                    <form action="delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $produit['id_produit']; ?>">
                        <th> <input type="submit" name="delete" class="btn btn-danger" value="Supprimer">
                    </form>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</body>
</html>
