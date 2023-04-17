#!/bin/bash

source "/app/.env.sh"

/usr/local/bin/php /app/cron.php --command="$1" >> /var/log/crontab.log 2>&1