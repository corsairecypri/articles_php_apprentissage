<?php session_start(); ?>


<!--Si la session de connexion n'existe pas, on redirige vers login.php-->
<?php
if (!isset($_SESSION['LOGGED_USER']))
{
    header('Location: login.php');
}
?>


<?php include_once('mysql.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <!-- Navigation -->
        <?php include_once('header.php'); ?>

        <h1>Liste des articles</h1>


        <?php
        $getData = $_GET;

        #On vérifie si l'article est bien présent
        #et que l'id est bien numérique

        if (!isset($getData['id']) && is_numeric($getData['id']))
        {
            echo('Il faut un identifiant de recette pour le modifier.');
            return;
        }

        ?>
        

        <!-- Si l'utilisateur est connecté, on affiche les articles -->
          
        <?php 
            
        #On récupére les articles de la base de données

        $retrieveArticleStatement = $mysqlClient->prepare(
        'SELECT authors.full_name, articles.title, articles.article_text, articles.date
        FROM authors
        INNER JOIN articles
        ON authors.id = articles.author_id
        where articles.id = :id');

        $retrieveArticleStatement->execute([
            'id' => $getData['id'],

        ]) or die(print_r($db->errorInfo()));

        $article = $retrieveArticleStatement->fetchAll();

            /*NOTE IMPORTANTE : quand on stocke des informations avec SQL,
            on les affiche de cette manière */

        
        ?>      <p> <?php echo $article[0]['title']; ?> </p> 
                <p> <?php echo $article[0]['article_text']; ?> </p> 
                <p> <?php echo $article[0]['full_name']; ?> </p> 
                <p> <?php echo $article[0]['date']; ?> </p> 
                      
    </div>


    <?php include_once('footer.php'); ?>

    
</body>
</html>