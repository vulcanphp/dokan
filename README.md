# Dokan - Free Minimal E-commerce PHP Web Application

Dokan is a lightweight and user-friendly online e-commerce PHP web application. It provides a simple and intuitive platform for businesses to set up their online stores and sell products effortlessly.

[Dokan Live Demo](http://dokan.free.nf)


## Features
- **Secure Transactions:** Ensures the security of transactions and sensitive information.
- **Payment Methods:** Dokan support popular payment methods such as: PayPal, Stripe and Cash on Delivery
- **Customizable:** Easily customize your store settings, products, and categories.
- **Easy to Use:** Dokan is a minimalist php application you can manage it just using few clicks.
- **Regular Updates:** Dokan provide integrated update mechanism and you can simply update the dokan from admin panel.
- **User-Friendly Interface:** Navigate effortlessly with our super slim, intuitive and user-friendly interface.
- **Hire Me** if you want to add new features such as: payment method, dynamic page, contact page and customize design etc in your website.
    - freelance.shain@gmail.com
    - 01969467747 (WhatsApp)

## System Requirements

Before you get started with Dokan, ensure that your system meets the following requirements:

- **PHP Version:** >= 8.2
- **PHP Extensions:**
  - curl
  - mb_string
  - ext-zip
  - pdo

## Getting Started

1. **Download Dokan:** [Dokan Latest Version](https://github.com/vulcanphp/dokan/releases/latest)
2. **Unzip:** After downloading the Dokan zip extract the source files on you project root directory.
3. **Setup Database:** /config/database.php

    ```php
    <?php

    return [
        // pdo driver
        'driver' => 'mysql',

        // database configuration
        'name' => '[name]',
        'host' => '[host]',
        'port' => '[port]',
        'user' => '[user]',
        'password' => '[password]',

        // database charset
        'charset' => 'utf8mb4',
        'collate' => 'utf8mb4_unicode_ci',
    ];

   ```
4. **Start the Application:**
    - **Production Server:** For Apache Server Just Hit your domain and it will open the Dokan Application.
    - **Development Server:**
    ```bash
    cd [your-app]

    php vulcan -s
   ```
   [learn more](https://github.com/vulcanphp/vulcanphp)
5. **Dokan Setup:** When you Start the Application a Configuration Page will Appear.
    - create a password for your admin panel to login
    - setup your store information from /admin/settings options
    - add category and products on your store
    - that's it

**Note:** For Non-Apache Production Server Make Sure Your Server Redirect all Http Request to index.php file.

## Support Dokan

If you find this project helpful and would like to support its continued development, consider [buying me a coffee](https://www.buymeacoffee.com/vulcandev). Your contribution helps me maintain the project, and dedicate more time to enhancing its features.

## Report an Issue

For additional support, feel free to [open a new issue](https://github.com/vulcanphp/dokan/issues) with a detailed description of the problem you are facing. I will be happy to assist you.

Start your online store with Dokan!
