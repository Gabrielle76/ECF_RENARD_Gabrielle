<!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="main.css">
            <title>Inscription</title>
        </head>
        <body>
        <div class="login-form">
            <?php 
                if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {
                        case 'success':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> inscription réussie !
                            </div>
                        <?php
                        break;

                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> mot de passe différent
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email non valide
                            </div>
                        <?php
                        break;

                        case 'email_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email trop long
                            </div>
                            <?php
                            break;
                    }
                }
                ?>
            
            <form action="inscription_traitement.php" method="post">
                <h2>Inscription</h2>       
                <div>
                    <input type="email" name="email" class="form-control" placeholder="Saisissez votre Email" required="required" autocomplete="off">
                </div>
                <div>
                    <input type="password" name="password" class="form-control" placeholder="Saisissez votre mot de passe" required="required" autocomplete="off">
                </div>
                <div>
                    <input type="password" name="password_retype" class="form-control" placeholder="Saisissez à nouveau votre mot de passe" required="required" autocomplete="off">
                </div>
                <div>
                    <button type="submit">Inscription</button>
                </div>   
            </form>
        </div>
        </body>
    </html>