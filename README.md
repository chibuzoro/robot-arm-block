# robot-arm-block
A problem involving manipulation of blocks by a robot arm

##Setup Guide
This project requires php 7.4 or higher and composer v2


##
Install the project package dependencies.

`composer install && composer dumpautoload`
#
if the PHP version isn't available on your machine, no worries. 
This package comes installed with Docker support. However, you will need to have a copy of the Docker Engine installed.
on your host machine? see #(https://www.docker.com/get-started)
#
Build the image
###
`docker build -t robot-arm-block .`
#
Run the container using the image
###
`docker run -it --rm --name robot-arm-block -v "$PWD":/usr/src/robot-arm-block -w /usr/src/robot-arm-block php:7.4-cli php robot.php commands.txt`

###
Run the container unit test
###
`docker run -it --rm --name robot-arm-block -v "$PWD":/usr/src/robot-arm-block -w /usr/src/robot-arm-block php:7.4-cli php vendor/bin/phpunit`
