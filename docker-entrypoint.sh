#!/bin/sh

cd /app
php artisan migrate

/usr/local/bin/mxnet-model-server --start --foreground --mms-config /home/model-server/config.properties --models densenet=https://dlc-samples.s3.amazonaws.com/pytorch/multi-model-server/densenet/densenet.mar