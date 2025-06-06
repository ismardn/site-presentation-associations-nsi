function changer_couleur(couleur) { // Fonction permettant de changer la couleur du fond du site, prenant en paramètre la couleur choisie
    document.body.style.backgroundColor = couleur; // La couleur du fond du corps de la page est changée en la couleur choisie
}

function pression_touche(touche) { // Fonction permettant de quitter les pages secondaires à l'aide de la touche "Échap" pour revenir à la page d'accueil, prenant en paramètre la touche pressée
    if (touche.keyCode === 27) { // Si la touche pressée est la touche Échap (son code associé est 27)
        window.location.assign("accueil.html"); // Replace la page à la page d'accueil
    }
}

function reinitialisation_formulaire() { // Fonction permettant de confirmer la réinitialisation du formulaire
    const choix_reinitialisation = confirm("Voulez-vous vraiment réinitialiser le formulaire ?"); // Affectation de la réponse à la boîte de message "confirm" à une varaiable
    return(choix_reinitialisation) // Retourne la réponse (true ou false, si l'utilisateur a respectivement répondu "OK" ou répondu "Annuler") et le formulaire est donc réinitialisé en fonction de celle-ci
}

function confirmation_envoi() { // Fonction permettant de confirmer l'envoi du formulaire, tout en vérifiant le contenu du tableau
    // Récupération des valeurs entrées dans le tableau du formulaire qu'on affecte à une variable
    const part_gains_missions_sociales = document.getElementById("part_gains_missions_sociales").value;
    const part_gains_frais_fonctionnement = document.getElementById("part_gains_frais_fonctionnement").value;
    const part_gains_frais_recherche_fonds = document.getElementById("part_gains_frais_recherche_fonds").value;

    if (Number(part_gains_missions_sociales) + Number(part_gains_frais_fonctionnement) + Number(part_gains_frais_recherche_fonds) !== 100) { // Si la somme des trois valeurs (qui sont convertie en nombre, puisqu'elle étaient des chaînes) n'est pas égale à 100
        alert('Erreur : la somme des nombres entrés dans le tableau doit être égale à 100. Veuillez entrer des nombres valides.'); // Ouvre une boîte de message indiquant le problème à l'utilisateur
        return false // Retourne false : le formulaire ne sera pas envoyée
    } else { // Si la somme des valeurs entrées dans le tableau est bien égale à 100, et qu'il a bien rempli tous les champs de saisie obligatoires, une boîte de confirmation demande à l'utilisateur s'il veut envoyer le formulaire
        const choix_envoi = confirm("Voulez-vous envoyer le formulaire ?");
        return(choix_envoi)
    }
}
