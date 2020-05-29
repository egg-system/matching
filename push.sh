#!/bin/sh
source ./.env

git clone -b${BUILD_BRANCH} https://github.com/egg-system/borderless-gym prod

docker build -tborderless-gym/app -fphp-fpm/prod.dockerfile .
docker build -tborderless-gym/nginx -fnginx/Dockerfile .

ECR_URI=${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_REGION}.amazonaws.com/borderless-gym
aws ecr get-login-password --region ${AWS_REGION} | \
    docker login --username AWS --password-stdin ${ECR_URI}
docker tag borderless-gym/app:latest ${ECR_URI}/app:${BUILD_TAG}
docker tag borderless-gym/nginx:latest ${ECR_URI}/nginx:${BUILD_TAG}

docker push ${ECR_URI}/app:${BUILD_TAG}
docker push ${ECR_URI}/nginx:${BUILD_TAG}

rm -rf prod