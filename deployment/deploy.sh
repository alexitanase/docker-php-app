#!/bin/bash

echo "------------FOR TESTING PURPOSE ONLY-----------"

source ./.dev.env

./build.sh

watch docker stack ps main-hub --filter desired-state=running