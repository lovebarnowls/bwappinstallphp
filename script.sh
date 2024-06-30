sudo echo -e "ubuntu\nubuntu" | passwd ubuntu
sudo apt update
sudo apt upgrade -y
sudo apt install apache2 mysql-server php php-mysql libapache2-mod-php unzip -y
sudo chmod 777 /var/www/html/
cd /var/www/html/
sudo wget https://sourceforge.net/projects/bwapp/files/latest/download -O bwapp.zip
sudo unzip bwapp.zip -d /var/www/html/
sudo chmod 777 /var/www/html/bWAPP
cd /var/www/html/bWAPP
sudo chown -R ubuntu:ubuntu /var/www/html/bWAPP
sudo chmod 777 /var/www/html/bWAPP
sudo rm install.php
sudo wget https://raw.githubusercontent.com/lovebarnowls/bwappinstallphp/main/install.php -O /var/www/html/bWAPP/install.php

sudo mysql -e "CREATE DATABASE bWAPP;"
sudo mysql -e "CREATE USER 'bwapp_user'@'localhost' IDENTIFIED BY 'password';"
sudo mysql -e "GRANT ALL PRIVILEGES ON bWAPP.* TO 'bwapp_user'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

sudo sed -i 's/\$db_username = "root";/\$db_username = "bwapp_user";/' /var/www/html/bWAPP/admin/settings.php
sudo sed -i 's/\$db_password = "";/\$db_password = "password";/' /var/www/html/bWAPP/admin/settings.php

sudo systemctl restart apache2
