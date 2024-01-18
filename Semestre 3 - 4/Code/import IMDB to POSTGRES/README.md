## Utilisation script bash

<p> Avant de lancer le script Bash pensé a exécuté ceci afin de donner les droits au fichier </p>
<code> chmod +x installation_autoImport.sh </code>
</br>
</br>
<p> Après avoir donné les droits au script Bash, exécuter le : </p>
<code> sudo ./installation_autoImport.sh </code>

## Fonctionnement script du Bash
<p>Le script Bash va d'abord vérifier les packages installés, si les packages ne sont pas installés, il les installera automatiquement. Il vérifie également les modules python nécessaire au fonctionnement du script python, s'ils ne sont pas installés celui-ci les installe automatiquement. </p>
<p>Après l'installation des dépendances, le script va créer un second script qui se nomme  <strong>"autoImport_IMDB_ro_POSTGRES.sh"</strong> celui-ci va exécuter main.py.</p>
<p> <strong>"installation_autoImport.sh"</strong> va ensuite configurer <strong>"cron"</strong>  qui exécutera le script <strong>"autoImport_IMDB_ro_POSTGRES.sh"</strong> quotidiennement à 4h30 chaque jour. Celui-ci créait également des logs accessibles avec la commande suivante : </p>
<code> cat /etc/DraCorporation/logs_autoImport_IMDB_to_POSTGRES.txt </code>

## Modifier l'heure d'exécution du script Bash avec "cron"

<p> Pour modifier l'heure d'exécution, il faut aller dans le fichier de configuration de "cron" accessible avec la commande suivant : </p>
<code> sudo nano /etc/crontab </code>
</br>
</br>
<p> Il faut ensuite modifier la dernière ligne, le 4 correspond aux heures et le 30 correspond aux minutes. <p>
<img src="https://user-images.githubusercontent.com/92891191/205443536-aec76fd5-9e8c-4f9b-a785-92b9af34ae53.png">

<p> Si on souhaite modifier l'heure à 9h45 par exemple, il faudra faire comme ceci </p>
<img src="https://user-images.githubusercontent.com/92891191/205443589-ee76699b-7634-48df-94ee-a1782c609e1d.png">
