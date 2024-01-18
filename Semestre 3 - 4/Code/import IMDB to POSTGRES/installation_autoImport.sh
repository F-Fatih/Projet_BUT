#! /usr/bin/env bash

##########   VERIFICATIONS PACKAGES   ##########
packagesPython=(python3 python3-pip cron)
for python in "${packagesPython[@]}"
do
	if dpkg -s $python | grep -q Status:
		then
        		echo -e "\033[0;32m$python : OK \033[m"
		else
        		echo -e "\033[0;31m$python : KO \033[m"
        		echo -e "\033[0;34mDémarrage installation $python - Veuillez patienter . . . \033[m"
        		sudo apt install $python

        		if dpkg -s $python | grep -q Status:
        			then
                			echo -e "\033[0;32m$python a bien été installé \033[m"
        			else
                			echo -e "\033[41;01;1mImpossible d'installer $python \033[m"
        		fi
	fi
done


##########   MAJ PIP   ##########
echo -e "\033[0;34mMise a jour pip\033[m"
pip install --upgrade pip


##########   VERIFICATIONS CURSOR   ##########
python3 -c 'import cursor' 2>/dev/null && test=true || test=false
if [ $test = true ] ;
	then
		echo -e "\033[0;32mModule cursor : OK\033[m"
	else
		echo -e "\033[0;31mModule cursor : KO\033[m"
		echo -e "\033[0;34mDémarrage installation cursor - Veuillez patienter . . . \033[m"
		pip install cursor
		
		python3 -c 'import cursor' 2>/dev/null && test2=true || test2=false
		if [ $test2 = true ] ;
			then
				echo -e "\033[0;32mcursor a bien été installé \033[m"
			else
				echo -e "\033[41;01;1mImpossible d'installer cursor \033[m"
		fi
fi


##########   VERIFICATIONS REQUESTS   ##########
python3 -c 'import requests' 2>/dev/null && test=true || test=false
if [ $test = true ] ;
	then
		echo -e "\033[0;32mModule requests : OK\033[m"
	else
		echo -e "\033[0;31mModule requests : KO\033[m"
		echo -e "\033[0;34mDémarrage installation requests - Veuillez patienter . . . \033[m"
		pip install requests
		
		python3 -c 'import requests' 2>/dev/null && test2=true || test2=false
		if [ $test2 = true ] ;
			then
				echo -e "\033[0;32mrequests a bien été installé \033[m"
			else
				echo -e "\033[41;01;1mImpossible d'installer requests \033[m"
		fi
fi


##########   VERIFICATIONS PSYCOPG2   ##########
python3 -c 'import psycopg2' 2>/dev/null && test=true || test=false
if [ $test = true ] ;
	then
		echo -e "\033[0;32mModule psycopg2 : OK\033[m"
	else
		echo -e "\033[0;31mModule psycopg2 : KO\033[m"
		echo -e "\033[0;34mDémarrage installation psycopg2 - Veuillez patienter . . . \033[m"
		pip install psycopg2-binary
		
		python3 -c 'import psycopg2' 2>/dev/null && test2=true || test2=false
		if [ $test2 = true ] ;
			then
				echo -e "\033[0;32mpsycopg2 a bien été installé \033[m"
			else
				echo -e "\033[41;01;1mImpossible d'installer psycopg2 \033[m"
		fi
fi


##########   CREATION SCRIPT AUTO IMDB   ##########
touch autoImport_IMDB_to_POSTGRES.sh
echo "#! /usr/bin/env bash

/usr/bin/python3 python/main.py
echo '==================================================================================='
echo 'Execution de : autoImport_IMDB_ro_POSTGRES.sh - le '
date 
echo 'en $SECONDS seconds'
echo '==================================================================================='" >> autoImport_IMDB_to_POSTGRES.sh
chmod +x autoImport_IMDB_to_POSTGRES.sh


##########   CONFIGURATION EXECUTION QUOTIDIENNE   ##########
sudo systemctl enable cron
echo -e "\033[0;32mcron activé\033[m"
sudo mkdir /etc/DraCorporation && sudo touch /etc/DraCorporation/logs_autoImport_IMDB_to_POSTGRES.txt
path=$(readlink -f autoImport_IMDB_to_POSTGRES.sh)
echo "30 4    * * *   root    $path >> /etc/DraCorporation/logs_autoImport_IMDB_to_POSTGRES.txt" >> /etc/crontab


##########   EXECUTION SCRIPT AUTO IMDB   ##########
echo -e "\033[0;32mExécution du script autoImport_IMDB_to_POSTGRES.sh \033[m"
./autoImport_IMDB_to_POSTGRES.sh


##########   FIN SCRIPT   ##########
echo -e "\033[42;01mConfiguration du script terminé \033[m"
echo "Vous pouvez consulter les logs ici --> /etc/DraCorporation/logs_autoImport_IMDB_to_POSTGRES.txt"
echo "Le script s'exécutera automatiquement tous les jours à 4h30."
echo "Vous pouvez modifier l'heure d'exécution ici --> /etc/crontab"
