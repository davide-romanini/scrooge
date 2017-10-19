pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                echo 'Building..'
                sh './make build'
                sh 'echo OK version $(cat VERSION) built!'
            }
        }

        stage('Build docker images) {
            steps {
                echo 'Building docker images..'
                sh './make build-docker-images'
                sh 'docker images'
                echo 'Done!'
            }
        }
    }
}
