RUN /usr/bin/composer install
RUN vendor/propel/propel/bin/propel migrate
