NAME=r.cfcr.io/anthonykgross/anthonykgross/sharindata

build:
	docker build --file="Dockerfile" --tag="$(NAME):master" .

install:
	docker-compose run sharindata install

debug:
	docker-compose run sharindata bash

run:
	docker-compose up
