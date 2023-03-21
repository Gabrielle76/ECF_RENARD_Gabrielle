<?php 
    session_start(); 
    require_once 'config.php'; 

    if (!empty($_POST['EmailUsers']) && !empty($_POST['password']))
    
    {
        $email = htmlspecialchars($_POST['EmailUsers']); 
        $password = htmlspecialchars($_POST['password']);
        
        $email = strtolower($email);
        
        $check = $nom_du_serveur->prepare('SELECT EmailUsers FROM utilisateur.users WHERE EmailUsers = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row == 1)
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                if(password_verify($password, $data['password']))
                {
                    $_SESSION['user'] = $data['token'];
                    header('Location:landing.php');
                    die();
                }else{ header('Location: index.php?login_err=password'); die(); }
            }else{ header('Location: index.php?login_err=email'); die(); }
        }else{ header('Location: index.php?login_err=already'); die(); }
    }else{ header('Location: index.php'); die();}