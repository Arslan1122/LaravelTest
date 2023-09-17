# Furniture Shop

### Why Stripe?

I choose stripe integration because I'm using the stripe from almost last 7 years. Besides that below are some reason I choose Stripe

1. **Developer-Friendly :** Stripe provides well-documented APIs and official Laravel packages (like Laravel Cashier) that make it easy for developers to integrate payment functionality into Laravel applications.
2. **Webhooks and Event Handling:** Stripe offers robust webhook support, enabling our application to respond to important events like successful payments, failed payments, refunds, disputes, and more. This ensures that our application can react appropriately to payment-related events.
3. **Client-Side Integration:** To provide a smooth and secure payment process, we've integrated Stripe Elements for client-side payment forms. This enhances the user experience during payment transactions
4. **Monitoring and Reporting:** To monitor payment transactions and gain insights into our project's financial performance, use Stripe's dashboard.


# How to run the project
Clone the Repo and Run:

```
composer install
```
After clone, you need to copy the env-example by running the following command

```
cp .env.example .env
```

Run the following command to compile assets
```
npm install 
npm run dev
```

Add Database credentials

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=createdBDName
DB_USERNAME=username
DB_PASSWORD=password
```

Now, you need to login into your Stripe account and paste the following keys into your .env file


```
STRIPE_KEY=
STRIPE_SECRET=
```


Run the migrations and seeder

```
php artisan migrate --seed
```

You need to add the email credentials to your .env to receive the email. you can use **Mailtrap** 

```
MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=TLS
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="Laravel"
```

SuperAdmin credentials (that is created via seeder)

```
email: admin@store.com
password: password
```

I handled the case for REVOKE payment. For that you need to setup the webhook in your stripe account. You need to replace the host: 

```
http://laraveltestproject.test/webhooks/stripe
```