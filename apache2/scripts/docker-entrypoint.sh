#!/bin/bash
printf "==========================================================\n"
printf "============== BOOTING HTCW WEBSITE CONTAINER ============\n\n"

printf "Running in %s mode \n" "${APP_ENV}"
if [ "$APP_ENV" == "prod" ]; then
  LOCAL_FILE=/var/www/html/.env.prod.local
  if [ -f "$LOCAL_FILE" ]; then
    printf "Removing old env file \n"
    rm ${LOCAL_FILE}
  fi

  printf "Dumping envs to .env.local.php  \n"
  composer --working-dir=/var/www/html dump-env prod
fi

printf "\n\n==================== HTCW WEBSITE BOOTED =================\n\n"

apachectl -D FOREGROUND