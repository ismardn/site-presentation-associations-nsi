<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>

        <title>Page réponse au formulaire - Grandes associations caritatives françaises</title>

        <link rel="icon" type="image/png" sizes="16x16" href="images/icone.png">

        <link rel="stylesheet" href="styles/style.css"/>

        <script src="scripts/script.js"></script>
    </head>

    <body onkeyup="pression_touche(event)">
        <a href="accueil.html"><img style="left: 1%" src="images/image-fleche-retour-arriere.png" alt="accueil.html" title="Retourner à la page d'accueil"></a>

        <?php
            // Récupération de toutes les valeurs entrées dans le formulaire qu'on affecte à une variable
            $nom_association = $_GET['nom_association'];
            $resume_fondation = $_GET['resume_fondation'];
            $objectifs_association = $_GET['objectifs_association'];
            $chiffres_cles = $_GET["chiffres_cles"];
            $part_gains_missions_sociales = $_GET["part_gains_missions_sociales"];
            $part_gains_frais_recherche_fonds = $_GET["part_gains_frais_recherche_fonds"];
            $part_gains_frais_fonctionnement = $_GET["part_gains_frais_fonctionnement"];
            $lien_site_association = $_GET["lien_site_association"];
            $lien_logo_association = $_GET["lien_logo_association"];

            if ($lien_logo_association == "") { // Si l'utilisateur n'a pas entré de lien pour le logo de l'association
                $lien_logo_association = "Aucun"; // On associe la valeur de cette variable à la chaine de caractère "Aucun"
            }

            // Affectation du contenu de l'e-mail à une variable (On y introduit toutes les informations du formulaire précédemment récupérées, afin que l'administrateur du site ait un maximum d'informations pour possiblement ajouter la page)
            $message = "Vous avez reçu une nouvelle proposition d'association !\n\n\n\nNom de l'association : " . $nom_association . "\n\nQuelques mots sur la fondation de l'association :\n\n" . $resume_fondation . "\n\nLes objectifs de cette association :\n\n" . $objectifs_association . "\n\nQuelques chiffres sur l’association :\n\n" . $chiffres_cles . "\n\nPart des gains pour missions sociales : " . $part_gains_missions_sociales . "\nPart des gains pour frais de recherche de fonds : " . $part_gains_frais_recherche_fonds . "\nPart des gains pour frais de fonctionnement : " . $part_gains_frais_fonctionnement . "\n\nLien du site officiel de l'association : " . $lien_site_association . "\n\nUn lien du logo de l'association : " . $lien_logo_association;

            // On définit les emplacement nécessaires au fonctionnement de la classe PHPMailer, qui permet d'envoyer des mails
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;
            //use PHPMailer\PHPMailer\SMTP; // Sert uniquement pour activer le débogueur
            require 'PHPMailer/src/Exception.php';
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';

            $mail = new PHPMailer(true); // On affecte la varaiable "mail" à la fonction PHPMailer

            try {
                $config = require 'includes/config.php';

                // Paramètres du serveur
                $mail->SMTPDebug = 0; // On désactive l'affichage du débogueur, qui sera inutile pour l'utilisateur : si une erreur survient, il en sera informé (mettre variable sur la valeur SMTP::DEBUG_SERVER pour afficher le débogueur)
                $mail->isSMTP(); // Utilisation du serveur SMTP qui est un serveur de messagerie chargé d'acheminer des emails sur Internet
                $mail->Host = 'smtp.gmail.com'; // Adresse SMTP
                $mail->SMTPAuth = true;
                $mail->Username = $config['smtp_username'];;
                $mail->Password = $config['smtp_password'];;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465; // Port SMTP

                // Expéditeur et destinataire
                $mail->setFrom($config['smtp_username']);
                $mail->addAddress($config['smtp_username']);

                // Définition du contenu
                $mail->Subject = "Proposition d'une association carritative"; // Objet du mail
                $mail->Body = $message; // Corps du mail

                $mail->send(); // On envoie l'e-mail

                echo // Si l'e-mail a bien été envoyé, l'utilisateur aura accès à un aperçu de ce à quoi pourrait ressembler la page s'il l'association est acceptée, avec une interface similaire à celle des autres associations
                "
                    <h1 class='titre' style='color: #4CBD35; font-size: 1.9em'>Votre proposition d'ajout de l'association \"$nom_association\" a bien été envoyée.</h1>
    
                    <h1 style='color: #7f00ff; font-size: 1.6em; margin: 50px 0 50px 10px'>Voici un aperçu de ce à quoi pourrait ressembler la présentation de votre association, si elle est approuvée :</h1>
                ";
                if ($lien_logo_association != "Aucun") { // Si l'utilisateur a entré un lien pour le logo de l'association
                    // On affiche le logo de la même manière que pour les autres pages présentant une association
                    echo "<a href=$lien_site_association><img style='top: 60px; right: 1%; width: 400px; height: 400px' src=$lien_logo_association alt=\"Logo de $nom_association\" title='Accéder au site de $nom_association'></a>";
                }
                echo "
                    <h2>Quelques mots sur la fondation de l'association</h2>
            
                    <p>$resume_fondation</p>
            
                    <h2>Quels sont les objectifs de cette association ?</h2>
            
                    <p>$objectifs_association</p>
            
                    <h2>Quelques chiffres sur l’association</h2>
            
                    <p>$chiffres_cles</p>
            
                    <h2>Où vont les gains de l'association ?</h2>
            
                    <table>
                        <tr>
                            <th></th>
                            <td>Part des gains (en %)</td>
                        </tr>
                        <tr>
                            <td>Missions sociales</td>
                            <td>$part_gains_missions_sociales</td>
                        </tr>
                        <tr>
                            <td>Frais de recherche de fonds</td>
                            <td>$part_gains_frais_recherche_fonds</td>
                        </tr>
                        <tr>
                            <td>Frais de fonctionnement</td>
                            <td>$part_gains_frais_fonctionnement</td>
                        </tr>
                    </table>
                ";
            } catch (Exception $e) { // Si l'e-mail n'a pas pu être envoyé
                echo "
                    <h1 class='titre' style='color: #E71A1A'>Une erreur est survenue ; votre proposition n'a pas pue être envoyée...</h1>
                    <br>
                    <p>$e</p>
                "; // On informe à l'utilisateur qu'un erreur est survenue
            }
        ?>
    </body>
</html>