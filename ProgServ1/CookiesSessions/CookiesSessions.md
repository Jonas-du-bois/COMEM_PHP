# Cookies - Sessions

## Exercice 1

Créez un formulaire avec un menu déroulant permettant de choisir langue de préférence de l'interface (français, allemand, anglais). Enregistrez la langue de préférence dans un cookies valables 30 jours. À l’ouverture de la page, récupérez ces valeurs, et afficher la page dans la langue adéquate, avec toujours le formulaire permettant de changer de langue.



## Exercice 2

Ecrire un script PHP qui permet de sauvegarder les heures de visites d'une page dans un cookie, et affiche les détails de visites comme suit:

Vous avez visité le site 3 fois :

- 05-10-2022 08:34:23
- 05-10-2022 08:40:26
- 05-10-2022 09:13:52

## Exercice 3

A l'aide d'un cookie, limitez la consultation d'une page à 3 visualisations.



## Exercice 4

Créer un formulaire de saisie d'adresse (nom, prénom, rue, numéro de rue, npa, localité) à la soumission du formulaire il s'agit de stocker ces informations dans une session afin quelles soient reprises lors d'une prochaine consultation du formulaire pour effectuer une modification.



## Exercice 5 : Authentification simple via les sessions

Nous voulons protéger le contenu d'une page html en demandant une authentification. De plus, l'utilisateur une fois authentifié ne doit pas avoir besoin de rentrer à nouveau son mot de passe pendant 15 minutes, même s'il ferme son browser entre deux. 

- Demander à l'utilisateur un `username` et un `password` via un formulaire. Seul un couple `username/password` doit être autorisé. 

- Vérifier si les valeurs reçues correspondent aux valeurs autorisées. 

  Si c'est le cas, stocker en session le fait que l'utilisateur est autorisé, afficher "Ceci est un contenu hautement protégé!", ainsi qu'un bouton `logout`.