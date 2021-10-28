# Attention la structure de la base de données a été changée depuis les première versions. Il faut donc la mettre à jour.

# PylRouge

## Présentation
Organisation de fils rouges Python pour suivi .
J'utilise personnellement l'outils Coderunner de Moodle, mais il m'a semblé intéressant d'avoir un outil autonome. 


Le principe de PylRouge est le suivant : 
- l'enseignant créé ses classes et les élèves de ses classes
- l'enseignant créé des questions Python (principalement écriture de fonctions) et définit des cas de test
- l'enseignant organise un fil rouge par classe : des questions ordonnées avec date d'ouverture et date de fermeture.
- les élèves ont accès au calendrier du fil rouge et réalisent les fonctions demandées. La validation se fait sur la base des cas de test.
- l'enseignant a accès aux résultats et peut modérer la validation (par exemple si une méthode est imposée par l'énoncé mais non respectée)

L'utilisation de cet outil est complémentaire du travail en cours et en TP et ne peut évidemment pas se suffire à lui même.


L'exécution des scripts python est rendue possible par Pyodide [https://github.com/pyodide/pyodide], l'édition du code est réalisée grâce aux outils Codemirror [https://codemirror.net/] et l'affichage MarkDown est réalisé par markdown-it [https://github.com/markdown-it/markdown-it]


## Installation

Copier l'ensemble des fichiers à la racine du site.
Créer une base de données avec un utilisateur et un mot de passe et modifier le fichier `connect.php`.
Importer la structure de la base de données  (fichier `filrouge.sql`).
Créer un compte prof : 
```SQL
INSERT INTO ENSEIGNANTS(nom,prenom,login,mdp) VALUES ("votre_nom","votre_prenom","votre_login",SHA2("votre_mdp",256));
```

Il me semble que cela doit suffire à démarrer le site. 

## Utilisation
Quelques copies d'écran

![Capture d’écran de 2021-10-27 11-11-30](https://user-images.githubusercontent.com/48787735/139036711-b2b5e0f7-813e-4214-a8c8-d48529f1d8e6.png)![Capture d’écran de 2021-10-27 11-11-16](https://user-images.githubusercontent.com/48787735/139036716-ff693c27-ddb5-4221-8b99-c2934eadd6fa.png)
![Capture d’écran de 2021-10-27 11-10-59](https://user-images.githubusercontent.com/48787735/139036717-ad526805-1746-467b-883a-cdbb10f5a06d.png)
![Capture d’écran de 2021-10-27 11-10-41](https://user-images.githubusercontent.com/48787735/139036719-c375c23b-ac89-479e-bfa8-c91ceff3bf91.png)
![Capture d’écran de 2021-10-27 11-10-18](https://user-images.githubusercontent.com/48787735/139036723-e5c4eb9b-0bd6-4062-9602-7310da024767.png)
![Capture d’écran de 2021-10-27 11-10-08](https://user-images.githubusercontent.com/48787735/139036725-5dfd687d-3915-4e84-8c58-a61b3bca8197.png)
![Capture d’écran de 2021-10-27 11-09-59](https://user-images.githubusercontent.com/48787735/139036727-ff4d85ba-c98f-41b7-b948-7320e6b50ad8.png)
![Capture d’écran de 2021-10-27 11-09-34](https://user-images.githubusercontent.com/48787735/139036731-6428b5b4-9f68-49b1-84b2-d8a3c055aa5f.png)
![Capture d’écran de 2021-10-27 11-09-15](https://user-images.githubusercontent.com/48787735/139036733-94c53f9b-7d59-4d46-9e6a-1ced96f2bc38.png)


## Problèmes connus
- gestion de la connexion/deconnexion à revoir sur certains points
- Problème de garbage collecting sous Firefox qui empèche parfois pyodide de se lancer. Dans ce cas il suffit d'ouvrir un nouvel onglet
