pipeline {
    agent { docker { image 'php:8.3.4-alpine3.19' } }
    stages {
        stage('PHP Build and Test') {
            steps {
                script {
                try {
                    if (fileExists('composer.json')) {
                    sh 'composer install'
                    sh 'phpunit'
                    } else {
                    // If composer.json doesn't exist, print a message and continue 
                    echo 'No composer.json found, skipping PHP build and test.'
                    }
                } catch (Exception e) {
                    currentBuild.result = 'FAILURE'
                    error("Error during PHP build and test: ${e.message}")
                }
                }
            }
        }
    }
}


