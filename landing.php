<?php 
    session_start();
    require_once 'config.php';

    if(!isset($_SESSION['user'])){
        header('Location:Page_connexion.php');
        die();
    }
    $req = $nom_du_serveur->query('SELECT * FROM utilisateur.users WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();
   
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Espace membre</title>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body>
        <div>
                <?php 
                        if(isset($_GET['err'])){
                            $err = htmlspecialchars($_GET['err']);
                            switch($err){
                                case 'current_password':
                                    echo "<div>Le mot de passe actuel est incorrect</div>";
                                break;

                                case 'success_password':
                                    echo "<div>Le mot de passe a bien été modifié ! </div>";
                                break; 
                            }
                        }
                ?>
                        <h1>Bonjour !</h1>
                        <hr />
                        <a href="deconnexion.php" class="btn">Déconnexion</a>
                       
                        <button type="button" class="btn" data-toggle="modal" data-target="#change_password">
                          Changer mon mot de passe
                        </button>
            </div>  

        <div id="change_password" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div role="document">
                <h4>Changer mon mot de passe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <div>
                <button type="button" class="btn" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
  </body>
</html>