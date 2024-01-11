<p align="center">
  <h3 align="center">NftToncoinBot - Telegram Bot</h3>
  <p align="center">
    Your Comprehensive Guide to Launching a Feature-Rich Telegram Bot!
    <br/>
    <a href="https://github.com/TGRTON/NftToncoinBot"><strong>Explore the Documentation »</strong></a>
    <br/>
    <a href="https://github.com/TGRTON/NftToncoinBot">View Demo</a>
    ·
    <a href="https://github.com/TGRTON/NftToncoinBot/issues">Report Bug</a>
    ·
    <a href="https://github.com/TGRTON/NftToncoinBot/issues">Request Feature</a>
  </p>
</p>

![Downloads](https://img.shields.io/github/downloads/TGRTON/NftToncoinBot/total)
![Contributors](https://img.shields.io/github/contributors/TGRTON/NftToncoinBot?color=dark-green)
![Issues](https://img.shields.io/github/issues/TGRTON/NftToncoinBot)
![License](https://img.shields.io/github/license/TGRTON/NftToncoinBot)

## Table Of Contents
* [About the Project](#about-the-project)
* [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
* [Usage](#usage)
* [Roadmap](#roadmap)
* [Contributing](#contributing)
* [License](#license)
* [Authors](#authors)
* [Acknowledgements](#acknowledgements)

## About The Project
The NftToncoinBot project is your gateway to launching a dynamic Telegram bot tailored for cryptocurrency enthusiasts. It's engineered for seamless communication, trading tokens like BloggerNFT, Blogger3D, NFTNude, and features a comprehensive referral program.

## Built With
Developed in procedural PHP version 7+, this project is streamlined for simplicity and wide compatibility. It operates without dependencies on external libraries, ensuring ease of deployment on any PHP and MySQL supported hosting. This approach also facilitates easy customization of the bot's code.

## Getting Started
To set up this project locally, follow these clear and concise steps.

### Prerequisites
- A hosting solution supporting PHP 7 and MySQL is required.

### Installation
To install and configure the bot, follow these steps:

1) **Configure the `config.php` File**:
   - Set up the main bot executable script: `tgbot.php`.
   - Edit `config.php` with your specific details:
     ```
     $admin = 00000; // ChatID of a manager/owner
     $urlToAvatar = "https://yourdomain/BotFolder/"; // URL to Avatar Folder
     $NFTwallet = "XXXXX"; // TON Wallet for payments
     $BloggerNFT = 75; // Price of BloggerNFT in TON
     $Blogger3D = 300; // Price of Blogger3D in TON
     $NFTNude = 25; // Price of NFTNude in TON
     $NFTRefPercent = 20; // Referral percent
     $XAPIKey = ""; // API Key of Toncenter website
     $CryptoPayAPIToken = ""; // CryptoPay API Token
     define('TOKEN', 'XXXXX'); // Bot API Token
     ```
   - Include Tegro Money details:
     ```
     $user_id = 0000; // User ID at Tegro Money
     $api_key = 'XXX'; // API Key
     $roskassa_publickey = 'XXXX'; // Public Key
     $roskassa_secretkey = 'XXXX'; // Secret Key
     ```

2) **Cryptopay Registration**:
   - [Register the bot](https://yourdomain/BotFolder/postback_cryptopay.php) in Cryptopay by specifying the postback URL.

3) **Tegro Money Postback URL**:
   - [Set the postback URL](https://yourdomain/BotFolder/postback.php) in Tegro Money account.

4) **Database Configuration**:
   - Fill in MySQL details in `global.php`.
   - Import the MYSQL database structure from `database.sql`.

5) **Webhook Installation**:
   - [Install the webhook](https://api.telegram.org/botXXXXX/setWebhook?url=https://yourdomain/BotFolder/tgbot.php) for the `tgbot.php` script.

6) **Customizing Bot Texts**:
   - Edit responses and texts in `lang.php`.

## Usage
To use the bot, search for `@YourBot` in the Telegram environment and initiate it using the `/start` command.

## Roadmap
For a detailed list of upcoming features and known issues, visit our [open issues](https://github.com/TGRTON/NftToncoinBot/issues).

## Contributing
Your contributions drive the growth of this open source project. We value and appreciate your input, suggestions, and improvements.

- **Open an Issue**: Feel free to [suggest changes](https://github.com/TGRTON/NftToncoinBot/issues/new).
- **Pull Requests**: Ensure to check spelling and grammar, and create individual PRs for each suggestion.
- **Code of Conduct**: Review our [Code Of Conduct](https://github.com/TGRTON/NftToncoinBot/blob/main/CODE_OF_CONDUCT.md) before contributing.

### Creating A Pull Request
1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License
For detailed licensing information, visit our [License](https://github.com/TGRTON/NftToncoinBot/blob/main/LICENSE) page.

## Authors
- **Lana Cool** - Developer - [Lana Cool's GitHub](https://github.com/lana4cool/) - Expertise in Telegram Bots on PHP

## Acknowledgements
- A special thank you to [Lana](https://github.com/lana4cool/) for their invaluable contributions and insights.

