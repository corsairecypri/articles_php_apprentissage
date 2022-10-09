
<!--On assure d'abord la connexion à la base de données
avec PDO-->

<?php
session_start();

include_once('mysql.php');


?>

<!--Si la session de connexion n'existe pas, on redirige vers login.php-->
<?php
if (!isset($_SESSION['LOGGED_USER']))
{
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site test</title>
    <!--Lien Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include_once('header.php'); ?>

    <h1>Ma page web</h1>

    <p>Aujourd'hui nous sommes le <?php echo date('d/m/Y h:i:s'); ?>.</p>


    <div class="container">

        <h2>Affichage des articles</h2>

        <!-- Si l'utilisateur est connecté, on affiche les articles -->
        

        <?php  
            #On récupére les articles de la base de données

            $retrieveArticlesStatement = $mysqlClient->prepare('SELECT * FROM articles');

            $retrieveArticlesStatement->execute() or die(print_r($db->errorInfo()));

            $articles = $retrieveArticlesStatement->fetchAll();


            foreach($articles as $article) {
                ?> <a href="article.php?id=<?php echo($article['id']); ?>"><p> <?php echo $article['title']; ?></p> </a><br>  <?php
            }
        ?>

              
    </div> 
    
    
    <h2>Formulaire de contact</h2>

    <form action="contact.php" method="POST">
        <!-- données à faire passer à l'aide d'inputs -->
        
        <input name="prenom" placeholder = "Votre prénom">
        <input name="nom" placeholder = "Votre nom">
    </form>
    

</body>