GROUPE :  Fatih FIDAN & Tamij SARAVANAN

Notre SAE contient 2 dossiers et 1 fichier pdf.
- Dans le premier dossier qui se nomme 'UML', vous pouvez retrouver notre diagramme UML en '.png' qui a été créée avec DIA (la sauvegarde du diagramme UML est également présente si vous souhaitez l'ouvrir directement avec DIA).
- Dans le second dossier qui se nomme 'Calculatrice Java', vous pouvez retrouver la partie programmation java de la calculatrice avec les différentes class qui ont été créé.
- Dans le fichier PDF vous pourrez retrouver un compte rendu qui recense tout ce que nous avons fait.


Vous avez des informations supplémentaires pour chaque class ci-dessous.


Nombre.java  : 
- Cette class contient la base de notre calculatrice avec 1 constructeur champ à champ (qui prend en paramètre un nombre de type 'int').
- Il possède 2 méthodes qui sont valeur (qui retourne la valeur du nombre) et toString (qui retourne une chaîne de caractères avec la valeur du nombre).

Operation.java : 
- Cette class est abstraite, il possède un constructeur champ à champ (qui prend en paramètre 2 nombres de types 'Nombre' précédemment créés avec le class Nombre). 
- Il possède 3 méthodes différentes les deux premiers, dont getOPerande1 et getOPerande2 (il retourne chacun le Nombre des opérandes), enfin il y a la méthode valeur de type int qui est abstrait.

Addition.java :
- Cette class héritée de la class Opération, il possède un constructeur champ à champ (qui prend en paramètre 2 nombres de type 'Nombre').
- Il possède 2 méthodes différentes les premières sont la méthode valeur (qui retourne une addition) et la deuxième est la méthode toString (qui retourne l'addition en question sous forme de chaîne de caractères).

Soustraction.java :
- Cette class héritée de la class Opération, il possède un constructeur champ à champ (qui prend en paramètre 2 nombres de type 'Nombre').
- Il possède 2 méthodes différentes les premières sont la méthode valeur (qui retourne une soustraction) et la deuxième est la méthode toString (qui retourne la soustraction en question sous forme de chaîne de caractères).

Multiplication.java :
- Cette class héritée de la class Opération, il possède un constructeur champ à champ (qui prend en paramètre 2 nombres de type 'Nombre').
- Il possède 2 méthodes différentes les premières sont la méthode valeur (qui retourne une multiplication) et la deuxième est la méthode toString (qui retourne la multiplication en question sous forme de chaîne de caractères).

Division.java :
- Cette class héritée de la class Opération, il possède un constructeur champ à champ (qui prend en paramètre 2 nombres de type 'Nombre') et qui crée une ArithmeticException si le deuxième nombre en paramètre est égal à 0, car effectivement il est impossible de diviser par 0.
- Il possède 2 méthodes différentes les premières sont la méthode valeur (qui retourne une division) et la deuxième est la méthode toString (qui retourne la division en question sous forme de chaîne de caractères).

CalculatriceSimple.java :
- Cette class contient une méthode main qui nous a permis de tester tous les class précédents décrits.


----------------------------------------------
-----------          Bonus          -----------
----------------------------------------------

Test.java :
- Cette class contient une méthode main avec les tests réalisés pour chaque class afin de voir s’il fonctionnait bien correctement.

TableMultiplication.java :
- Cette class contient une méthode main avec toutes les tables de multiplication qui sont calculées avec notre class Multiplication.

