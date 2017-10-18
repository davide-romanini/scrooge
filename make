#!/bin/bash
function start {
    docker-compose up -d
}

function build {
    composer install -o --apcu-autoloader --no-dev
    echo $(version) > VERSION
}

function build-dev {
    composer install
}

function version() {
  # https://stackoverflow.com/questions/3300746/deriving-application-build-version-from-git-describe-how-to-get-a-relatively
  git describe --exact-match 2> /dev/null || echo "`git symbolic-ref HEAD 2> /dev/null | cut -b 12-`-`git log --pretty=format:\"%h\" -1`"
}

function composer {
    # better run without docker-compose
    docker run --rm -u www-data -ti -v $(pwd):/var/www davideromanini/scrooge-php composer $@
}

# init / updates the full coa db for local development
function update-local-db {
    docker run --rm -u www-data -ti -v $(pwd):/var/www -e MYSQL_USER=coa -e \
           MYSQL_HOST=db -e MYSQL_PASSWORD=coa davideromanini/scrooge-php ./bin/updatedb.sh
}

func=$1
shift
$func "$@"
