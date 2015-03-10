<?php 
include ("partials/header.php");

if (isset($_FILES['csv'])) {

    $dossier = 'csv/';
    $fichier = basename($_FILES['csv']['name']);
    $extensions = array('.csv');
    $extension = strrchr($_FILES['csv']['name'], '.'); 
    if(!in_array($extension, $extensions))
    {
        $erreur = 'Vous devez uploader un fichier de type csv';
    }
    if(!isset($erreur))
    {
        $fichier = strtr($fichier, 
                         'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                         'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
        if(move_uploaded_file($_FILES['csv']['tmp_name'], $dossier . $fichier))
        {
            header("Location:result.php?filename=" . $_FILES['csv']['name']);
        }
        else
        {
            echo 'Echec de l\'upload !';
        }
    }
    else
    {
        echo $erreur;
    }
}

?>

<body>

    <header>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="img/logo.png" width="25px"> csv2html</a>
                </div>
            </div>
        </nav>

    </header> 

    <div class="container">

        <div class="starter-template">

            <?php

if(isset($_GET['errorcode'])){
    if($_GET['errorcode'] == 1){
        echo "<div class='alert alert-danger'>
            <p>Votre fichier n'est pas compatible ou corrompu !</p>
        </div>";
    }
}

            ?>
            <div class="well">

                <h1>Comment ça marche ?</h1>
                <p>Uploader votre fichier csv dans le champs ci-dessous, cliquer par la suite sur lancer la conversion pour obtenir la page HTML.</p>
            </div>

            <div class='alert alert-info'>
                <p>Pour enregistrer le résultat, vous devez faire un clique droit sur ce dernier, puis enregistrer en tant que format web html !</p>
            </div>

            <div class="well">


                <br>
                <form action="#" method="post" class="form-signin" role="form" enctype="multipart/form-data" >
                    <label for="csv">Fichier csv :</label>
                    <input type="file" class="form-control" id="csv" name="csv" required>
                    <br>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Lancer la conversion</button>
                </form>
            </div>


        </div>

        <?php include ("partials/footer.php") ?>


