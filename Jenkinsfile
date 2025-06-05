pipeline {
    agent { label 'agent-php' }
    stages {
        stage('Continuous Integration') {
            steps {
                git branch: 'main', url: 'https://github.com/JossBvd/TP_backend_deployment_cda'
            }
        }
        stage('Deploy via FTP') {
            steps {
                sh '''
                    lftp -d -u $jocelyn_ftp_nom,$jocelyn_ftp_mdp ftp-jocelyn1.alwaysdata.net -e "
                        mirror -R /home/jenkins/workspace/jocelyn-td-backend/ www/;
                        bye
                    "
                '''
            }
        }
        stage('Install Composer & .env') {
            steps {
                sh """
                    sshpass -p "$SSH_PASS" ssh -o StrictHostKeyChecking=no jocelyn1@ssh-jocelyn1.alwaysdata.net '
                        cd ~/www && composer install --no-dev &&
                        echo "DB_HOST=mysql-jocelyn1.alwaysdata.net" > .env &&
                        echo "DB_NAME=${DB_NAME}" >> .env &&
                        echo "DB_USER=jocelyn1" >> .env &&
                        echo "DB_PASS=${DB_PASSWORD}" >> .env
                    '
                """
            }
        }
        stage('Migration') {
            steps {
                sh """
                    sshpass -p "$SSH_PASS" ssh -o StrictHostKeyChecking=no jocelyn1@ssh-jocelyn1.alwaysdata.net '
                        cd ~/www && php migrate.php
                    '
                """
            }
        }
    }
}