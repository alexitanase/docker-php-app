FROM 127.0.0.1:5000/feedhunt-backend:latest
RUN apt-get install -y procps

COPY ./deployment/crontab /etc/cron.d/crontab
RUN chmod 0644 /etc/cron.d/crontab

ADD ./deployment/cron-start.sh /entrypoint.sh
ADD ./deployment/cron-exec.sh /app/

WORKDIR /app

ENTRYPOINT /entrypoint.sh

HEALTHCHECK --interval=5s --timeout=3s \
    CMD ps aux | grep '[c]ron' || exit 1
