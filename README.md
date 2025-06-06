# Site de présentation d’associations humanitaires

Ce projet présente plusieurs associations humanitaires connues à travers une interface web, avec possibilité d’ajouter de nouvelles associations via un formulaire. Un email est envoyé automatiquement grâce à l’intégration de PHPMailer.

Le projet a été réalisé dans le cadre de la spécialité NSI au lycée.

## Fonctionnalités
- Pages de présentation pour plusieurs associations
- Formulaire HTML d’ajout d’association
- Envoi des données par email via PHPMailer
- Utilisation de PHP pour le traitement du formulaire
- Intégration d’images et logos pour chaque association

## Structure
- `accueil.html` : page d’accueil du site
- Pages HTML individuelles pour chaque association (ex. : `croix-rouge.html`)
- `formulaire-ajout-association.html` : formulaire d’ajout
- `reponse-formulaire.php` : traitement du formulaire et envoi d’email
- `PHPMailer/` : bibliothèque pour l’envoi de mails
- `images/` : icônes et logos des associations
- `includes/config.php` : fichier de configuration (mail, mot de passe)

## Visiter le site

Placer les fichiers sur un serveur local avec support PHP (comme `XAMPP`), puis ouvrir `accueil.html` dans le navigateur, à partir de `localhost`.

Le formulaire nécessite la configuration du fichier `includes/config.php` avec une adresse email et un mot de passe (un "mot de passe d’application" peut être nécessaire, par exemple avec Gmail).

---

Projet réalisé en février 2022, mis en ligne ici en juin 2025.
