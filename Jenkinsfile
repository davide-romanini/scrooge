pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                echo 'Building..'
                sh './make build'
                sh 'echo OK version $(cat VERSION) built!'
                echo 'Changed from WEBHOOK'
            }
        }

        stage('Build docker images') {
            steps {
                echo 'Building docker images..'
                sh './make build-docker-images'
                sh 'docker images'
                echo 'Done!'
            }
        }

        stage('Push docker images') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'docker-hub-credentials', passwordVariable: 'PASS', usernameVariable: 'USER')]) {
                    sh 'docker login -u $USER -p $PASS'
                    echo 'Building docker images..'
                    sh './make push-docker-images'
                    echo 'Done!'
                }
                
            }
        }
    }
}
