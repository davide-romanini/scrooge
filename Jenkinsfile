pipeline {
    agent {
        docker { 
            image 'davideromanini/scrooge-php' 
            args '-u www-data'
        }
    }

    stages {
        stage('Build') {
            steps {
                echo 'Building..'
                sh 'composer install -o --apcu-autoloader --no-dev'
            }
        }
    }
}
