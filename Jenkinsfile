pipeline {
    agent {
        docker { image 'davide-romanini/scrooge-php' }
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
