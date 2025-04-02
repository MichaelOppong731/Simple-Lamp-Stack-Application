pipeline {
    agent any


    environment {
        AWS_REGION = "us-east-1"  // Change to your AWS region
        SONAR_SCANNER_HOME = tool 'SonarQubeScanner'
        ECR_REPOSITORY = "lampstack/application"
        AWS_ACCOUNT_ID = "180294222815"
        IMAGE_TAG = "latest"
        SONARQUBE_SERVER = "SonarQubeScanner" // Set this to match SonarQube's configuration in Jenkins
        SONAR_PROJECT_KEY = "lampstackSonar"
        SONAR_AUTH_TOKEN = credentials('test-token')
        URL_REGISTRY = '180294222815.dkr.ecr.eu-west-1.amazonaws.com/lampstack/application:latest'
        
    }

    stages {
        stage('Checkout Code') {
            steps {
                echo "Cloning the Git repository..."
                git branch: 'main', url: 'https://github.com/MichaelOppong731/Simple-Lamp-Stack-Application.git'
            }
        }

    

        stage('SonarQube Code Analysis') {
            steps {
                echo "Running SonarQube analysis..."
                script {
                    withSonarQubeEnv(credentialsId: 'test-token') {
                        sh """
                        ${SONAR_SCANNER_HOME}/bin/sonar-scanner \
                        -Dsonar.projectKey=${SONAR_PROJECT_KEY} \
                        -Dsonar.sources=. \
                        -Dsonar.host.url=http://localhost:9000 \
                        -Dsonar.token=\$SONAR_AUTH_TOKEN
                        """
                    }
                }
            }
        }
    
        stage('Build Docker Image') {
            steps {
                script {
                    echo "Building Docker image..."
                    sh "docker build -t ${ECR_REPOSITORY}:${IMAGE_TAG} ."
                    echo "Image built successfully..."
                }
            }
        }
    

        stage('Trivy Image Scan') {
            steps {
                script {
                    echo "Running Trivy security scan..."
                    sh """
                    trivy image --exit-code 1 --severity HIGH,CRITICAL ${ECR_REPOSITORY}:${IMAGE_TAG} || echo 'Security vulnerabilities detected'
                    """
                }
            }
        }

        stage('Login to AWS ECR') {
            steps {
                script {
                    withCredentials([usernamePassword(credentialsId: 'AWS_LOGIN', usernameVariable: 'AWS_ACCESS_KEY_ID', passwordVariable: 'AWS_SECRET_ACCESS_KEY')]) {
                        // Login to ECR
                        echo "Logging into AWS ECR..."
                        sh """
                        aws ecr get-login-password --region ${AWS_REGION} | docker login --username AWS --password-stdin ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_REGION}.amazonaws.com
                        echo "Login successful!"}
                        """
                    }
                    
                }
            }
        }

        stage('Push Docker Image to ECR') {
            steps {
                script {
                    echo "Pushing Docker image to AWS ECR..."
                    sh """
                    docker tag ${ECR_REPOSITORY}:${IMAGE_TAG} ${URL_REGISTRY}
                    docker push ${URL_REGISTRY}
                    echo "Image pushed to ECR successfully!"
                    """
                }
            }
        }
    }

    post {
        success {
            echo "Pipeline completed successfully!"
        }
        failure {
            echo "Pipeline failed!"
        }
    }
}
