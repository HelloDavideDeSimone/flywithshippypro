FROM node:12.22.4-alpine

LABEL maintainer="Davide De Simone <deda34grix@gmail.com>"

WORKDIR /app

ENV YARN_VERSION 1.22.4

RUN apk add --no-cache --virtual .build-deps-yarn \
            curl \
    && curl -fSLO --compressed "https://yarnpkg.com/downloads/$YARN_VERSION/yarn-v$YARN_VERSION.tar.gz" \
    && tar -xzf yarn-v$YARN_VERSION.tar.gz -C /opt/ \
    && ln -snf /opt/yarn-v$YARN_VERSION/bin/yarn /usr/local/bin/yarn \
    && ln -snf /opt/yarn-v$YARN_VERSION/bin/yarnpkg /usr/local/bin/yarnpkg \
    && rm yarn-v$YARN_VERSION.tar.gz \
    && apk del .build-deps-yarn

ARG UID='1000'
ARG GID='1000'
RUN deluser --remove-home node \
  && addgroup -S node -g ${GID} \
  && adduser -S -G node -u ${UID} node
USER node

CMD sh -c "yarn install && yarn run serve"
