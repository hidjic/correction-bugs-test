# Test

Les dépendances sont à installer avec Composer.

Pour lancer les tests:

```php
vendor/bin/phpunit
```

Instructions :

- faire passer les tests qui ne passent pas : cela implique de corriger les éventuels bugs existants et implémenter la fonctionnalité manquante
- refactoriser le code existant si besoin pour rendre du code "propre" et maintenable
- ne pas modifier data.json
- ne pas retirer des tests (en ajouter est OK)



Voila ce que j'ai fait

 - changement du != null en utilisant la fonction native !is_null
 - écriture de la function pour faire la moyenne en fonction d'une date
 - création d'un fonction qui retourne un tableau d'objet json
