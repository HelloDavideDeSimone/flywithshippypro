FROM nginx:1.19.10-alpine

LABEL maintainer="Davide De Simone <deda34grix@gmail.com>"

RUN rm /etc/nginx/conf.d/default.conf
COPY resources/01_gateway.conf /etc/nginx/conf.d/01_gateway.conf
COPY resources/02_api.conf /etc/nginx/conf.d/02_api.conf
COPY resources/03_frontend.conf /etc/nginx/conf.d/03_frontend.conf