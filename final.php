<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['mail'];
    $age = $_POST['age'];
    $sexe = $_POST['sexe'];
    $numero = $_POST['numero'];
    $nomR = $_POST['nomR'];
    $code = $_POST['code'];
    $ville = $_POST['ville'];
    $nationalite = $_POST['nationalite'];
    $pays = $_POST['pays'];
    $exp = $_POST['exp'];
    $activities = isset($_POST['activite']) && is_array($_POST['activite']) ? $_POST['activite'] : [];
    $password = $_POST['mot1'];
    $confirm_password = $_POST['mot2'];
    $consent = isset($_POST['consent']) ? $_POST['consent'] : '';

    if (empty($nom) || empty($prenom) || empty($email) || empty($age) || empty($sexe) || empty($numero) || empty($nomR) || empty($code) || empty($ville) || empty($nationalite) || empty($pays) || count($activities) < 2 || count($activities) > 4 || empty($password) || empty($confirm_password) || empty($consent)) {
        echo "Tous les champs sont obligatoires, vous devez choisir entre 2 et 4 activités, et donner votre consentement.";
    } elseif ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
    } else {
        $data = "$nom;$prenom;$email;$age;$sexe;$numero;$nomR;$code;$ville;$nationalite;$pays;$exp;" . implode(", ", $activities) . ";$password;$consent\n";
        $result = file_put_contents('utilisateur.txt', $data, FILE_APPEND);
        
        if ($result === false) {
            echo "Erreur lors de l'enregistrement des données.";
        } else {

            echo "Bienvenue sur le site $prenom $nom.";
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Formulaire d'inscription</title>
   
</head>
<body>
    <fieldset>
        <h2>Formulaire d'inscription</h2>
        <form action="" method="post" onsubmit="return validateActivities()">
            <div class="champ">
                <legend><h3>Informations personelles:</h3></legend>
                <label for="nom">Nom de famille:</label>
                <input type="text" id="nom" name="nom" required>
            </div>  
            <div class="champ">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="champ">
                <label for="mail">Adresse mail :</label>
                <input type="email" id="mail" name="mail" required>
            </div>
            <div class="champ">
                <label for="age">Âge :</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="champ">
                <input type="radio" id="h" name="sexe" value="homme" required>
                <label for="h">Homme</label>
                <input type="radio" id="f" name="sexe" value="femme" required>
                <label for="f">Femme</label>
            </div></fieldset>
           <fieldset><legend><h3>Adresse Postale:</h3></legend>
             <div class="champ">
                <label for="numero">Numéro de voie:</label>
                <input type="number" id="numero" name="numero" required>
            </div>
            <div class="champ">
                <label for="nomR">Nom de rue:</label>
                <input type="text" id="nomR" name="nomR" required>
            </div>
            <div class="champ">
                <label for="code">Code postal:</label>
                <input type="number" id="code" name="code" required>
            </div>
            <div class="champ">
                <label for="ville">Ville:</label>
                <input type="text" id="ville" name="ville" required>
            </div></fieldset>
            <fieldset><legend><h3>Origine:</h3></legend>
                <div class="champ">
                <label for="nationalite">Nationalité:</label>
                <select id="nationalite" name="nationalite" required>
                    <?php
                    if (($handle = fopen("nationality.csv", "r")) !== FALSE) {
                        fgetcsv($handle); 
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            echo "<option value=\"$data[0]\">$data[0]</option>";
                        }
                        fclose($handle);
                    }
                    ?>
                </select>
            </div>
            <div class="champ">
                <label for="pays">Pays de naissance:</label>
                <select id="pays" name="pays" required>
                    <?php
                    if (($handle = fopen("pays.csv", "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            $lastWord = end($data);
                            echo "<option value=\"$lastWord\">$lastWord</option>";
                        }
                        fclose($handle);
                    }
                    ?>
                </select>
            </div></fieldset>
           <fieldset> <div class="champ">
                <label for="exp"><legend><h3>Présentation:</h3></legend></label>
                <textarea name="exp" placeholder="Décrivez-vous brièvement" maxlength="978" required></textarea>
            </div>
            <div class="champ">
                <label for="activite">Activités:</label>
                <select id="activite" name="activite[]" multiple required>
                    <?php
                    $file = file('activity.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    foreach ($file as $line) {
                        echo "<option value=\"$line\">$line</option>";
                    }
                    ?>  
                </select>
            </div></fieldset>
           <fieldset><legend><h3>Confirmation:</h3></legend>
             <div class="champ">
                <label for="mot1">Mot de passe:</label>
                <input type="password" id="mot1" name="mot1" required>
            </div>
            <div class="champ">
                <label for="mot2">Confirmez votre mot de passe:</label>
                <input type="password" id="mot2" name="mot2" required>
            </div>
            <div class="champ">
                <label>
                    <input type="checkbox" name="consent" required> J'accepte le traitement et l'enregistrement de mes données pour un usage interne et à but non commercial
                </label>
            </div></fieldset>
            <input type="submit" value="S'inscrire">
        </form>
    
</body>
</html>
