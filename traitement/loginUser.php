<?php

$content = "";


if (isset($_POST['envoyer']) && $_POST['envoyer'] == "Envoyer") {



    extract($_POST); // Convertir les indices en variables

    $queryUserValide = "SELECT * FROM user WHERE email_user = ?";
    $userValide = $DB->db->prepare($queryUserValide);
    $userValide->execute(
        [
            $email
        ]
    );

    $rowUserValide = $userValide->fetch(PDO::FETCH_ASSOC);


    if (!empty($email) && !empty($password)) {
        if (password_verify($password, $rowUserValide['password_user'])) {
            
            if ($email == "admin@gmail.com" && $password == "footvintageadmin") {
                $_SESSION['user']['role'] = $rowUserValide['role_user'];
                header('location:profil_admin.php');
                exit();
            }
            $_SESSION['user']['id'] = $rowUserValide['id_user'];
            $_SESSION['user']['pseudo'] = $rowUserValide['pseudo_user'];
            $_SESSION['user']['name'] = $rowUserValide['name_user'];
            $_SESSION['user']['firstName'] = $rowUserValide['firstName_user'];
            $_SESSION['user']['gender'] = $rowUserValide['gender_user'];
            $_SESSION['user']['address'] = $rowUserValide['address_user'];
            $_SESSION['user']['postalCode'] = $rowUserValide['postalCode_user'];
            $_SESSION['user']['city'] = $rowUserValide['city_user'];
            $_SESSION['user']['phone'] = $rowUserValide['phone_user'];
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['password'] = $password;
            $_SESSION['user']['role'] = $rowUserValide['role_user'];
            header('location:profil_user.php');
            exit();      
        } else {
            $content .= "Erreur";
        }
    }
}