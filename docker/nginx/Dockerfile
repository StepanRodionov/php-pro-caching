FROM nginx:latest

RUN apt-get update \
    && apt-get install -y  \
    nginx

COPY nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www
VOLUME /var/www
EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]