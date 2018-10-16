FROM php:7.2-cli

ENV OAI_SPEC_URL="https://raw.githubusercontent.com/sendgrid/sendgrid-oai/master/oai_stoplight.json"

WORKDIR /root

# install Prism
RUN curl -sL https://raw.githubusercontent.com/stoplightio/prism/master/install.sh -o install.sh && \
      sh ./install.sh && \
      rm ./install.sh

# set up default sendgrid env
RUN mkdir sendgrid-php
COPY entrypoint.sh ./

ENTRYPOINT ["/root/entrypoint.sh"]
CMD ["--mock"]
