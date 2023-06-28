<?php

namespace Apps\Entity;

class TimeConnexion
{
public function TimeSession(){// Démarrez la session


// Définissez le temps limite d'inactivité en secondes (par exemple, 5 minutes)
    $tempsInactiviteLimite = 600; // 10 minutes

// Vérifiez si le dernier temps d'activité est défini et plus ancien que le temps limite
    if (isset($_SESSION['dernierTempsActivite']) && (time() - $_SESSION['dernierTempsActivite']) > $tempsInactiviteLimite) {
        // Déconnectez l'utilisateur et détruisez la session
        $_SESSION['Time'] = "F";
    }

// Mettez à jour le dernier temps d'activité avec le temps actuel
    $_SESSION['dernierTempsActivite'] = time();
}
}