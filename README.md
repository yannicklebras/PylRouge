# PylRouge

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
