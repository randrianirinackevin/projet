Formulaire PHP
Description
Ce projet est un formulaire PHP basique permettant de collecter des informations utilisateur et de les traiter. Le formulaire contient des champs tels que le nom, l'email et le message. Les données saisies par l'utilisateur sont envoyées à un script PHP qui les valide et les enregistre.

Prérequis
Serveur web (comme Apache)

PHP 7.0 ou version ultérieure

Installation
Clonez le référentiel sur votre machine locale :

bash
git clone https://github.com/username/projet-formulaire.git
Accédez au répertoire du projet :

bash
cd projet-formulaire
Déplacez les fichiers du projet dans le répertoire racine de votre serveur web (par exemple, htdocs pour XAMPP).

Utilisation
Ouvrez votre navigateur web et accédez à l'URL de votre serveur local où les fichiers sont hébergés, par exemple : http://localhost/projet-formulaire.

Remplissez le formulaire avec les informations requises et soumettez-le.

Structure des fichiers
index.php : Page principale contenant le formulaire.

process.php : Script PHP traitant les données du formulaire.

Validation
Le script process.php effectue les validations suivantes :

Vérifie que tous les champs sont remplis.

Valide le format de l'adresse email.

Affiche un message de succès ou d'erreur en fonction de la validation.

Contributions
Les contributions sont les bienvenues ! Veuillez soumettre une pull request pour toute amélioration ou correction.
