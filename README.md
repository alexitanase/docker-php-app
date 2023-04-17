# Base template

## Backend

Clone `backend/env` to `backend/.env`

### cron.php

- docker-compose exec php php cron.php --command=[FUNCTION]

### Propel commands:

- docker-compose exec php vendor/bin/propel diff
- docker-compose exec php vendor/bin/propel migrate
- docker-compose exec php vendor/bin/propel model:build