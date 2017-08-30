NAME=r.cfcr.io/anthonykgross/anthonykgross/sharindata

build:
	docker build --file="Dockerfile" --tag="$(NAME):master" .

install:
	docker-compose run sharinvideo install

debug:
	docker run -it --rm --entrypoint=/bin/bash $(NAME):master

run:
	docker-compose up