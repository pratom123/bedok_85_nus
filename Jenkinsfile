pipeline {
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
                sh 'composer install'
            }
        }
        stage('Unit Tests') {
            steps {
                sh 'phpunit tests'
                xunit([
                    thresholds: [
                        failed ( failureThreshold: "0" ),
                        skipped ( unstableThreshold: "0" )
                    ],
                    tools: [
                        PHPUnit(pattern: 'build/logs/junit.xml', stopProcessingIfError: true, failIfNotNew: true)
                    ]
                ])
                publishHTML([
                    allowMissing: false,
                    alwaysLinkToLastBuild: false,
                    keepAll: false,
                    reportDir: 'build/coverage',
                    reportFiles: 'index.html',
                    reportName: 'Coverage Report (HTML)',
                    reportTitles: ''
                ])
                discoverGitReferenceBuild()
                // recordCoverage(tools: [[parser: 'COBERTURA', pattern: 'build/logs/cobertura.xml']])
            }
        }
    }
}


