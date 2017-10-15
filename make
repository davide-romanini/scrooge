#!/bin/bash
function start {
    docker-compose up -d
}

function build {
    composer install
}

function composer {
    docker-compose run --rm -u www-data php composer $@
}

# init / updates the full coa db for local development
function update-local-db {
    docker-compose run --rm -e MYSQL_USER=coa -e MYSQL_HOST=db -e MYSQL_PASSWORD=coa php ./bin/updatedb.sh
}

func=$1
shift
$func "$@"
