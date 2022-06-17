PARTIE II

GROUPE :  Fatih FIDAN & Tamij SARAVANAN

Notre SAE contient 1 dossier et 1 fichier pdf.
- Dans le dossier qui se nomme 'Calculatrice Java', vous pouvez retrouver la partie II de la programmation java de la calculatrice avec la différente class qui a été créée.
- Dans le fichier PDF vous pourrez retrouver un compte rendu qui recense tout ce que nous avons fait.


Vous avez des informations supplémentaires pour chaque class ci-dessous.


Expression.java
- Cette class est abstraite, il ne possède pas de constructeur. 
- Il possède une méthode valeur de type double et qui est abstraite.

Nombre.java  : 
- Cette class hérite de la class Expression et contient la base de notre calculatrice avec 1 constructeur champ à champ (qui prend en paramètre un nombre de type 'int').
- Il possède 2 méthodes qui sont valeur (qui retourne la valeur du nombre) et toString (qui retourne une chaîne de caractères avec la valeur du nombre).

Operation.java : 
- Cette class est abstraite et hérite de la class Expression, il possède un constructeur champ à champ (qui prend en paramètre 2 nombres de types 'Expression' précédemment créés avec le class Nombre qui hérite d'Expression). 
- Il possède 3 méthodes différentes les deux premiers, dont getOPerande1 et getOPerande2 (il retourne chacun le Nombre des opérandes), enfin il y a la méthode valeur de type double qui est abstrait.

Addition.java :
- Cette class héritée de la class Opération, il possède un constructeur champ à champ (qui prend en paramètre 2 nombres de type 'Expression').
- Il possède 2 méthodes différentes les premières sont la méthode valeur (qui retourne une addition) et la deuxième est la méthode toString (qui retourne l'addition en question sous forme de chaîne de caractères).

Soustraction.java :
- Cette class héritée de la class Opération, il possède un constructeur champ à champ (qui prend en paramètre 2 nombres de type 'Expression').
- Il possède 2 méthodes différentes les premières sont la méthode valeur (qui retourne une soustraction) et la deuxième est la méthode toString (qui retourne la soustraction en question sous forme de chaîne de caractères).

Multiplication.java :
- Cette class héritée de la class Opération, il possède un constructeur champ à champ (qui prend en paramètre 2 nombres de type 'Expression').
- Il possède 2 méthodes différentes les premières sont la méthode valeur (qui retourne une multiplication) et la deuxième est la méthode toString (qui retourne la multiplication en question sous forme de chaîne de caractères).

Division.java :
- Cette class héritée de la class Opération, il possède un constructeur champ à champ (qui prend en paramètre 2 nombres de type 'Expression') et qui crée une ArithmeticException si le deuxième nombre en paramètre est égal à 0, car effectivement il est impossible de diviser par 0.
- Il possède 2 méthodes différentes les premières sont la méthode valeur (qui retourne une division) et la deuxième est la méthode toString (qui retourne la division en question sous forme de chaîne de caractères).

Calculatrice.java :
- Cette class contient une méthode main qui nous a permis de tester tous les class précédents décrits.

----------------------------------------------
-----------          Bonus          -----------
----------------------------------------------

Test.java :
- Cette class contient une méthode main avec les tests réalisés pour chaque class afin de voir s’il fonctionnait bien correctement.

