FROM node:lts-alpine3.15 as builder

RUN mkdir -p /tmp/farmer
WORKDIR /tmp/farmer

COPY farmer/package.json /tmp/farmer/
COPY farmer/package-lock.json /tmp/farmer/

RUN npm set progress=false && npm config set depth 0
RUN npm install

RUN npm cache clean -f

COPY farmer /tmp/farmer
COPY ./deployment/.farmer-env /tmp/farmer/.env
#COPY .farmer.fingerprint /tmp/farmer/.fingerprint

#RUN npm run build

#CMD npm run dev

#HEALTHCHECK CMD wget -q --method=HEAD localhost/status.txt