
# README AP3 !
*[Lien vers le rapport du projet](/rapport.pdf)*

Il est nécessaire pour mettre en place l'environnement d'avoir quelques connaissances en SQL, et préparer la [documentation Symfony](https://symfony.com/doc/current/setup.html) en cas de pépin. J'encourage vivement de rechercher toute question n'étant pas spécifique à ce projet, afin d'éviter toute zone d'incertitude lors de l'installation et par soucis de garder ce guide concis. Le processus d'installation des logiciels ainsi que leur démarrage initial ne seront pas couverts.

Pour commencer, il faut installer MySQL (8.0.12), avec si possible Workbench d’installé. MySQL et Workbench sont disponibles et facilement téléchargeables avec MySQL Installer Community edition, à [cette adresse](https://dev.mysql.com/downloads/installer/)

La prochaine dépendance est [PHP](https://www.php.net/), notre version est la 8.1.6 (installée grâce à [XAMPP](https://www.apachefriends.org/fr/index.html) ou [WAMPServer](https://wampserver.aviatechno.net/)). Sous Windows, installer PHP depuis le site est assez difficile, il vaut donc mieux lorsque l'on ne sait pas comment faire d'utiliser XAMPP ou WAMPServer.
_Note: La documentation de Symfony préconise aujourd'hui un PHP 8.2+._

Une fois ces deux dépendances installées, installer Symfony CLI, comme indiqué dans la [documentation Symfony](https://symfony.com/doc/current/setup.html). Il facilitera l'installation du projet.

En ce qui concerne les outils facultatifs, je recommande d'installer [Visual Studio Code](https://code.visualstudio.com/) au préalable. Tout IDE fera l'affaire, mais les extensions VSCode Git Graph, Prettier, Todo Tree, Twig Language 2, CSS Language Features et PHP Language Features aident à l'avancement du projet.
Installer un outil de versioning comme [Git](https://git-scm.com/)/[GitHub Desktop](https://desktop.github.com/) est également conseillé, ce dernier étant plus intuitif mais nécessitant aussi Git.

Ensuite, cloner/fork [le projet (ici)](https://github.com/SauroMatheo/ap3-robin-matheo), et au besoin, demander l'accès à @SauroMatheo.

Avec ces dépendances et outils, nous pouvons enfin nous lancer dans l'initialisation du projet.

---
1.  Mise en place du compte application

Nous allons rajouter un compte dans MySQL, qui sera uniquement utilisé par Symfony. Contrairement à Java, il n'y a rien de spécial à installer pour le faire fonctionner. Ouvrir MySQL Server Command Line (Unicode de préférence, évite les bugs de caractères), et taper le mot de passe root (voir documentation MySQL si le mot de passe est inconnu).

**À noter que ce compte est bien uniquement destiné à Symfony, et non pas à un utilisateur ou développeur !**

Voici les informations utilisées pendant notre période de développement:
| Champs | Valeur |
|--|--|
| Nom Compte | app3 |
|Nom BDD| ap3mathin|
|Mot de passe|M47h1nEtSoir
|Adresse|localhost:3306

_Remarque: Le développement s'est fait en se connectant localement, mais un test pour s'assurer que se connecter à une autre base a été fait._
_Remarque 2: le nom de la BDD ayant le jeu de données est aussi ap3mathin, penser à modifier le nom du schema si le nom de la BDD est modifié._

Taper ensuite ces trois commandes, en remplaçant les informations par celles par défaut ou celles choisies:
`CREATE USER 'NomCompte'@'Adresse' IDENTIFIED BY 'MotDePasse';`
- Créé l’utilisateur
- Il sera fort probable que le mot de passe requiert un symbole, 8 caractères, une majuscule, une minuscule et un chiffre, selon les paramètres de sécurité choisis lors de l'installation de MySQL.
- Remplacer Adresse par % pour autoriser de n'importe quelle connection

`GRANT ALL PRIVILEGES ON \*.* TO 'NomCompte'@'%';`
- Donne des permissions au compte, solution de simplicité
- Il est mauvaise pratique d’utiliser ALL, mais nécessaire pour que Symfony puisse générer/mettre à jour/intégrer la BDD

`FLUSH PRIVILEGES;`
- Met en oeuvre les changements de comptes sans redémarrer le serveur
    
Après ces commandes exécutées sans erreur, ouvrir Visual Studio Code et ouvrir le fichier `.env`. Aller à la ligne 27, et modifier les informations avec celles choisies ou par défaut, sous ce format:
`DATABASE_URL="mysql://NomCompte:MotDePasse@Adresse:Port/NomBDD?serverVersion=8.0.31&charset=utf8mb4"\`
- ATTENTION ! L’hôte doit être joignable sur ce port !
-  Ne pas oublier d'ouvrir ou de modifier le port au besoin (les chiffres après les deux points dans l'IP, par défaut: 3306)
- L’IP est obtenable par ipconfig en local (**Uniquement en phase de test ou développement !**), ou par des outils en ligne comme WhatsMyIP.
- Si le serveur n’est pas joignable à distance, vérifier la configuration de my.ini sous Windows ou mysql.cnf sous Linux, elle pourrait bloquer les tentatives de connexion.
- Dans le cas d'une autre solution SQL, modifier les autres informations.

---
2. Préparer l'environnement de développement Symfony

Une fois MySQL de fait, ouvrir un terminal dans la racine du projet (possible sur VSCode) et écrire:
`composer install`
Symfony ira alors installer toutes les dépendances selon le projet. Cette étape peut prendre une dizaine de minutes, plus ou moins, selon la machine et la connexion.

Résolution de problèmes:
- Si la commande n'est pas reconnue (comme pour Matheo), tenter `symfony composer install`. C'est étrange, mais peut régler un problème
- S'assurer que toutes les dépendances sont installées

Ensuite, il est possible de faire une migration, pour s'assurer que la base de données est adaptée au code. Pour ce faire, taper ces deux commandes:
`php bin/console make:migration`
Si ça semble être bon, confirmer avec:
`php bin/console doctrine:migrations:migrate`
- Si la base de données n'existe pas en premier lieu, il est possible que cela génère une erreur.

---
  3. Execution de l’application

Lorsque tout ceci est fait, on peut enfin lancer le site !
Toujours dans le terminal, exécuter `symfony server:start`. Laisser le terminal ouvert, et aller dans son navigateur. Se connecter à `localhost:8000/accueil`. Le site devrait maintenant apparaître, et il est possible de naviguer en local.

Il est possible de modifier le site pendant qu'il est actif. Tant que le terminal où `symfony server:start` reste ouvert, il est possible d'ouvrir un autre terminal ou de modifier le code. Attention cependant: dans le cas de la modification d'une image ou du CSS,  faire un hard refresh en faisant Ctrl + F5 ou Ctrl + Maj + R. Ceci efface le cache, et évite les problèmes d'affichage liés à une ancienne visite.

*S'il y a un problème difficile à résoudre, contacter l'un des contributeurs du projet sur GitHub, si possible les personnes spécialisées (voir rapport.pdf) ou une personne qualifiée. Les erreurs communes sont une mauvaise configuration du pare-feu, une mauvaise adresse rentrée, PHP n'étant pas dans la variable d'environnement, mauvaise configuration de .env, plusieurs personnes sur le même projet ont des BDD différentes ou qui ne sont pas à jour, le serveur MySQL est éteint...*

---
4. Développement

Maintenant que nous pouvons développer, voici quelques concepts à connaître (spécifiques ou non à ce projet):

#### Commentaires
À défaut d'une documentation Javadocs ou similaire, j'ai pris soin de commenter un maximum possible les fichiers .php. Bien que les commentaires ne soient pas des plus utiles dans les fichiers des entités, j'espère que le reste aidera à la compréhension et sera utile.

#### base.html.twig
Ce fichier est la base de toute page. Il s'y trouve à l'intérieur le header, footer et la mention du CSS global. Il est important d'éviter toute modification de ce fichier, à moins d'être certain que la modification de l'apparence de la page doit se refléter sur toutes les pages.

#### Fiches de style
Puisqu'il y a la possibilité d'avoir une page template (base.html.twig), dans le même raisonnement, nous utilisons une feuille de style globale (style.css) en plus d'un autre fichier .css, par page le nécessitant. Ainsi, nous pouvons garder une unicité à travers les pages, sans avoir à réécrire ou copier le code.

#### Images
Pour éviter les erreurs lors du développement, j'ai tendance à copier ce bout de code lorsque je fais référence à un article:
```twig
{% if  article.lesImages  is  empty %}
	<img  src="{{ asset( 'image/image_cassee.png' ) }}">
{% else %}
	<img  src="{{ asset( 'image/articles/' ~  article.lesImages[0].lienImage ) }}">
{% endif %}
```
Il permet de charger la première image de l'article si elle existe, sinon, affiche une image cassée. J'ai pensé assez tard dans le développement qu'il serait sûrement possible de directement modifier l'entité article pour adopter ce comportement, mais il serait aussi normal d'interdir de mettre un produit en place sans image.

Similairement, lorsque je veux afficher toutes les images d'un article, après ce premier bout de code, je mets aussi ceci:
```twig
{% for  image  in  article.lesImages[1:] %}
	<div  class="small-img">
		<img  src="{{ asset( 'image/articles/' ~  image.lienImage ) }}"  alt="Produit Image">
	</div>
{% endfor %}
```

#### ArticlesRepository, findSearch() et Recherche
J'ai écrit la méthode findSearch de manière à ce qu'il soit assez simple et évident de mettre des critères de recherche en plus. Je pars du principe qu'un argument peut être vide, et lorsqu'il ne l'est pas, j'ajoute ce critère à la requête. Ainsi, cette méthode est polyvalente à facile à étendre.
Il serait peut-être plus sage d'utiliser le workflow conseillé par Symfony, mais la fonction recherche étant à la base uniquement prévue pour ces deux champs, il semblait plus judicieux de faire cette méthode plutôt que de créer de nouveaux fichiers et formulaires.

Aussi, il serait bon dans un futur distant de rajouter une méthode permettant de trouver des articles aléatoirement, ou par un critère de popularité, afin d'être affichés dans cet ordre, plutôt que l'ordre dans lequel ils ont été rajoutés.

#### Et ensuite ?
Je conseille de lire le rapport.pdf et regarder le screenshot du Trello pour avoir une meilleure idée de l'avancement. Il va sans dire qu'un bon endroit pour commencer est le Lot B: implémenter la base de donnée comme décrite dans le MCD, et modifier/adapter les méthodes et programmes utilisant l'ancien modèle déprécié. Ensuite, implémenter le panier et les utilisateurs ensemble. De là, il sera possible assez facilement pas mal de petites fonctions. Le plus lourd est la BDD à faire avec Symfony (**Attention, en faisant des entités puis migrer, et non pas utiliser MySQL !**) en s'assurant que c'est possible de retourner en arrière à tout moment.

Je peux aussi rajouter ici, avec ce qui est écrit ci-dessus, qu'il est possible d'améliorer la recherche par exemple en mettant un meilleur algorithme pour le nom (par mot par exemple), de trouver un meilleur moyen d'afficher des images cassées, et de regrouper d'autres fiches de styles selon les besoins. Ce sont des choses qui étaient secondaires en vue du reste du cahier des charges à remplir au maximum.

---
Merci d'avoir lu cette courte documentation, et je vous recommande de lire le fichier rapport.pdf. Encore une fois, n'hésitez pas à contacter un contributeur au moindre doute !
