*** faire que la modif + ajout des catégo pas possible en dehors admin
donc liens clickables n'existe plus directement dans la card

*** security
- finir les asserts

** Finir Front 
- catégories
- gérer UI/UX avec messages flashs comme celui supprimer avec template dédié

* Installer les **dépendances** : 

    ```bash
    composer install
    ```

* Dupliquer le fichier `.env` et le renommer `.env.local`

* Mettre vos informations de **connexion** à la base de donnée

* Créer la BDD :
    
    ```bash
    php bin\console d:d:c
    ```

* Si il y en a, executez les **migrations** :

    ```bash
    php bin\console d:m:m
    ```

**Memo** :
https://github.com/code-gt/Tutoriel-Symfony/blob/main/Memo.md