#!/bin/bash

declare -p | grep -Ev 'BASHOPTS|BASH_VERSINFO|EUID|PPID|SHELLOPTS|UID' > /app/.env.sh

chmod +x /app/.env.sh

touch /var/log/crontab.log

chown application /var/log/crontab.log

crontab /etc/cron.d/crontab

cron -f &
tail -f /var/log/crontab.log