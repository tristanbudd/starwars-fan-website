# StarWars Fan Website
![](https://img.shields.io/github/stars/tristanbudd/starwars-fan-website.svg) ![](https://img.shields.io/github/forks/tristanbudd/starwars-fan-website.svg) ![](https://img.shields.io/github/issues/tristanbudd/starwars-fan-website.svg)

## Project Description
This website is a fan-focused Star Wars hub featuring articles, guides, and interactive media. It covers movies, characters, planets, and vehicles, with rich content including images, links, and code blocks.

The platform is fully responsive for all devices, integrates with the Discord API for real-time community info, and includes custom Star Wars-themed icons and animations. An SEO-friendly structure and a basic admin panel make managing and discovering content easy.

---

## Features
- Fully mobile-responsive design, optimized for all devices down to 300px width.
- Rich, fully functional articles supporting images, links, and code blocks.
- Dedicated guides sections covering Star Wars movies, characters, planets, and vehicles.
- Discord API integration for real-time Discord server and user information.
- Sleek, modern, futuristic design inspired by the Star Wars universe.
- Interactive media support, including embedded videos and gifs.
- Custom Star Wars-themed icons and animations for immersive navigation.
- SEO-friendly structure for better discoverability.
- Admin panel for easy content management. (Quite basic as of current)

---

## Preview Images
Below are examples showcasing different sections of the website:

---

## Installation / Setup

1. **Clone the repository**:
    ```
    git clone https://github.com/tristanbudd/starwars-fan-website.git
    ```
    ```
    cd starwars-fan-website
    ```

2. **Install PHP dependencies** using Composer:
    ```
    composer install
    ```
3. **Set up your environment file**:
    - Create a `.env` file in the root directory.
    - Add the following variables (update values as needed):

    ```
    MYSQL_HOST=localhost
    MYSQL_PORT=3306
    MYSQL_USERNAME=root
    MYSQL_PASSWORD=
    MYSQL_DATABASE=starwars_website
    SECRET_KEY=your_secret_key_here
    ```

4. **Ensure your web server is running**:
    - Apache with PHP enabled
    - MySQL/MariaDB server

5. **Database setup**:
    - Create a database matching the name in your `.env` file (`starwars_website` by default).
    - Update the `.env` credentials if your MySQL username/password/host differs.

6. **Access the admin panel**:
    - Navigate to `[your-site-path]/admin/auth.php` to authenticate using your `SECRET_KEY`.
    - Once authenticated, you will be redirected to `[your-site-path]/admin/admin.php`.

---

> ⚠️ Make sure `SECRET_KEY` is a strong, unique value to secure the admin panel. Currently, the code checks for a GUID Format (Can generate one at: https://www.guidgenerator.com/)

---

## Support

Have a question or need help?

Open an issue on GitHub:
[https://github.com/tristanbudd/starwars-fan-website/issues](https://github.com/tristanbudd/discord-commit-github-action/issues)

---

## License

[MIT](LICENSE)
