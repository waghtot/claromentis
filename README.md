# Claromentis Test Project

The project has been created and tested on Ubuntu 22.04.

**Steps to Run the Project:**

1. Move the project to your `/var/www/vhost/` directory, maintaining the following full project path:
   `/var/www/vhost/claromentis/`

2. As a root user, add the following line (using `nano` or `vim` as an editor):
   ```
   127.0.0.1   clarometis.dev.com
   ```
   to the `hosts` file located at:
   ```
   /etc/hosts
   ```

3. In your `/etc/apache2/sites-available/` directory, create a new file by copying `000-default.conf` as a root user and name it `claromentis.conf`.

4. Edit the `claromentis.conf` file and make the following additions and changes:

   ```
   ServerName claromentis.dev.com
   ServerAlias www.claromentis.dev.com

   ServerAdmin webmaster@localhost
   DocumentRoot /var/www/vhost/claromentis  # or use the appropriate location for your project folder.

   # Update the following lines:
   ErrorLog ${APACHE_LOG_DIR}/error.log
   CustomLog ${APACHE_LOG_DIR}/access.log combined

   # To:
   ErrorLog ${APACHE_LOG_DIR}/claromentis.dev.com.error.log
   CustomLog ${APACHE_LOG_DIR}/claromentis.dev.com.access.log combined

   # Right after the '</VirtualHost>' tag, add:
   <Directory /var/www/vhost/claromentis>
       Options Indexes FollowSymLinks
       AllowOverride All
       Require all granted
   </Directory>
   ```

   Save and close the file.

5. Ensure that the `apache2` `mod_rewrite` module is enabled, as it is required for the rewrite engine from the `.htaccess` file to redirect all incoming requests to the `index.php` file.

6. As the root user, run the following commands:
   ```
   sudo a2ensite claromentis.conf
   sudo systemctl restart apache2.service
   ```

7. Navigate to:
   ```
   /var/www/vhost/claromentis/app/core/
   ```

8. As the root user, execute the following command to change permissions recursively and allow read and write permissions:
   ```
   chmod 777 -R archive/
   ```

   Note: In a production environment, permissions should be set according to security group settings and company standards. However, for this exercise, these permissions are acceptable.

9. Open your web browser and enter the following URL:
   ```
   http://claromentis.dev.com
   ```

**Additional Project Details:**

The project has been overengineered and includes a few extra functionalities, such as directories for all three file statuses:

- **Queue**: For files supplied to the project by other applications.
- **Failed**: For cases involving the wrong file format or integrity issues.
- **Processed**: For files that have been processed successfully but require storing of the original file, which can be reprocessed if needed at any time.

All files from these directories can be processed again or deleted as necessary.