
# Installation

1. **Clone or download this Repository.**
2. **Run the command**
   ```
   composer install
   ```
   if you get any problems while running above command then run the following command.
   ```
   composer install --ignore-platform-reqs
   ```

3. **Create `.env` file by copying the `.env.example`, or run the following command**
   ```
   cp .env.example .env
   ```

4. **Update the database name and credentials in `.env` file**
   ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE="Your database name"
    DB_USERNAME="your database username"
    DB_PASSWORD="your database password"
   ```
   
5. **Update the mail credentials in `.env` file**
   ```
    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME="yours"
    MAIL_PASSWORD="yours"
    MAIL_ENCRYPTION=tls
   ```   
   
6. **Update the stripe credentials in `.env` file**
   ```
    STRIPE_KEY="yours"
    STRIPE_SECRET="yours"
   ```
7. **Run the following command**
   ```
   php artisan migrate --seed
   ```
8. **Run npm command**
   ```
   npm install
   ```
9. **Run the command to compile the theme**
    ```
    npm run dev
    ```
10. **Finally run the application**
   ```
   php artisan serve --port=8000
   ```
## You can login using following url for admin and customer.

- http://127.0.0.1:8000/admin/login admin@gmail.com/123345678
- http://127.0.0.1:8000/customer/login john@gmail.com/123345678
