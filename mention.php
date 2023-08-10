
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détermination de la mention</title>
    <!-- Ajouter le lien vers Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Détermination de la mention</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="moyenne" class="form-label">Entrez la moyenne générale :</label>
                <input type="text" class="form-control" id="moyenne" name="moyenne" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Vérifier</button>
            </div>
        </form>

        <?php
        // Fonction pour vérifier si la moyenne est valide (entre 0 et 20 inclus)
        function is_valid_moyenne($moyenne) {
            return is_numeric($moyenne) && $moyenne >= 0 && $moyenne <= 20;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer la valeur de la moyenne saisie dans le formulaire
            $moyenne = floatval($_POST["moyenne"]);

            // Vérifier si la moyenne est valide, sinon redemander la saisie
            while (!is_valid_moyenne($moyenne)) {
                echo '<div class="alert alert-danger mt-3" role="alert">';
                echo 'Veuillez saisir un nombre entre 0 et 20.';
                echo '</div>';
                exit; // Sortir du script si la saisie n'est pas valide
            }

            // Définir les variables décision et mention
            $decision = ($moyenne >= 10) ? "Admis" : "Éliminé";
            $mention = "";

            // Déterminer la mention en fonction de la moyenne
            if ($moyenne >= 17) {
                $mention = "Excellent";
                $badge_color = "primary";
            } elseif ($moyenne >= 16) {
                $mention = "Très Bien";
                $badge_color = "success";
            } elseif ($moyenne >= 14) {
                $mention = "Bien";
                $badge_color = "info";
            } elseif ($moyenne >= 12) {
                $mention = "Assez Bien";
                $badge_color = "warning";
            } elseif ($moyenne >= 10) {
                $mention = "Passable";
                $badge_color = "secondary";
            } else {
                $mention = "Non Admis";
                $badge_color = "danger";
            }

            // Afficher la décision et la mention avec la couleur Bootstrap appropriée
            echo '<div class="mt-3">';
            echo '<p>Décision : <span class="fw-bold">' . $decision . '</span></p>';
            echo '<p style="font-size: 14px;">Mention : <span class="badge bg-' . $badge_color . '" style="font-size: 14px;">' . $mention . '</span></p>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>

