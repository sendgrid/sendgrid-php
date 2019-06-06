FROM php:7.1-cli

ENV OAI_SPEC_URL="https://raw.githubusercontent.com/sendgrid/sendgrid-oai/master/oai_stoplight.json"
ENV SENDGRID_API_KEY $SENDGRID_API_KEY

# install Prism
WORKDIR /root

# install Prism
ADD https://raw.githubusercontent.com/stoplightio/prism/master/install install.sh
RUN apt-get update && apt-get install dos2unix
RUN chmod +x ./install.sh && sync && \
    dos2unix ./install.sh && \
    ./install.sh && \
    rm ./install.sh


# set up default Twilio SendGrid env
WORKDIR /root

RUN mkdir sendgrid-php
COPY entrypoint.sh entrypoint.sh
RUN chmod +x entrypoint.sh
RUN dos2unix ./entrypoint.sh
ENTRYPOINT ["./entrypoint.sh"]
CMD ["--mock"]
