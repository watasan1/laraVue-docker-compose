FROM node:8.15.0-alpine

WORKDIR /app

RUN apk update && \
    npm install -g npm && \
    npm install -g @vue/cli && \
    npm install axios && \
    npm install vue-router \
    npm install vue bootstrap-vue bootstrap

WORKDIR /var/www