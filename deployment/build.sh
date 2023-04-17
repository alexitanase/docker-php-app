#!/bin/bash
#git pull --recurse-submodules

export registry_url=127.0.0.1:5000
export project_name=feedhunt
export default_images="proxy redis backend cronjob"
#export default_images="websocket"


if [ ! -z "$1" ]
then
  export default_images="$1"
fi

export propel_image=${project_name}-backend

./build-docker-images.sh

watch docker stack ps feedhunt --filter desired-state=running