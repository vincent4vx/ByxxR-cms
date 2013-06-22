# ByxxR 2.0, l'apogé de l'évolution

ByxxR 2.0, le CMS alliant sécurité, fonctionnalités et performances !

## Déjà pourquoi ByxxR ?
 ByxxR pour Byxx Reload / Remake. ByxxR la plus grosse reprise de Byxx'CMS jamais faite !
 Tout a été revus, le code php, l'organisation, le css, l'html... Tout ça pour vous offrir le meilleur expérience possible sur un CMS Open-source !

## Que sera ce cms ?
 Ce cms n'aura en fait rien à voir question code à Byxx, contrairement à tout les dérivés de Byxx actuels.
 D'où le Remake, il est totalement refait de A à Z.
 Seule chose qui ne changera pas trop, c'est sont design, quasi parfait.

## Les différences avec byxx
 - Sécurité : code refait à 100%, pas de shell, utilisation de PDO au lieu de mysql_
 - Propreté : codé suivant le pattern MVC, utilisant mieux php, code plus clair et organisé
 - Puissance : Pas de framework, donc pas de fonctions inutiles chargées, système de cache pour éviter les requêtes SQL trop nombreuses
 - Fonctionnalités : Les fonctionnalités présentes sont plus poussés que sur Byxx, en se basant sur des technologies web récentes, comme ajax.

## Et ByxxR 1.0 ?
 Après réflexion, j'ai remarqué que twig ne m'était pas de grande utilité, et ralentissait plus qu'autre chose.
 J'ai donc choisi de le supprimer, permettant ainsi d'avoir de meilleurs performances. De ce fait, toute la base à dû être refaite.
 Cette nouvelle base garanti un meilleur code, et un puissance à la hausse (Benchmarks si dessous, par rapport à ByxxR 1.0).
 De plus de nouvelles fonctionnalités vont voir le jour, comme la validation des formulaires via ajax...
 
## Benchmarks :
- Temps d'exécution moyen (avec cache) : 6ms (~30% plus rapide)
- Temps d'exécution sans cache (page complexe) : 11ms (~90% plus rapide)
- utilisation de mémoire : 300 Kb (~30% de moins)

## Liens :
 - Lien GitHub : https://github.com/vincent4vx/ByxxR-cms
 - ByxxR 1.0 : http://byxxr.olympe.in/
 - Lien de test : http://byxxr.ynova.fr/
 
Merci de respecter notre travail, en laissant le copyright !
