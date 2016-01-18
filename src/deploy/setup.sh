#!/bin/sh
SCRIPT=$(readlink -f $0)
SCRIPTPATH=`dirname $SCRIPT`
PROJECTPATH=$SCRIPTPATH/..

DOMAINE=$(echo $PROJECTPATH | sed 's/\///g' | sed 's/\.//g')
rm $SCRIPTPATH/$DOMAINE -Rf 

echo "#Tous les jours à 0h00
0 0 * * * root php $PROJECTPATH/app/console kkuetnet:sharindata:update --env=prod
" > $SCRIPTPATH/$DOMAINE

cp $SCRIPTPATH/$DOMAINE /etc/cron.d/ -Rf
rm $SCRIPTPATH/$DOMAINE -Rf
chmod 644 /etc/cron.d/$DOMAINE
service cron restart

rm $PROJECTPATH/app/cache/* -Rf 
chmod 777 $PROJECTPATH/ -Rf
php $PROJECTPATH/app/console assetic:dump --env=prod
php $PROJECTPATH/app/console assets:install --env=prod
chmod 777 $PROJECTPATH/ -Rf
