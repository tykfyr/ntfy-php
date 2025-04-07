# tykfyr/ntfy-php

A simple PHP wrapper for [ntfy.sh](https://ntfy.sh) – send push notification directly from PHP.

## 🚀 Installation

```bash
composer require tykfyr/ntfy-php
```

## 📦 Usage

```php
use Tykfyr\Ntfy\Client;

$ntfy = new Client('my-topic');

$ntfy->send('Backup job finished!');
$ntfy->send('Deployment failed!', [
    'priority' => 5,
    'title' => '🚨 Fejl i deployment',
    'tags' => ['warning', 'deploy'],
    'click' => 'https://example.com/status'
]);
```

## ⚙️ Configuration
You can set the default topic and server URL in the constructor:

```php
$ntfy = new Client('alerts', [
    'base_url' => 'https://ntfy.example.com',
    'auth' => 'Bearer your-token'
]);
```

## 🧪 Test
You can run the tests using PHPUnit. Make sure you have PHPUnit installed and run:

```bash
vendor/bin/phpunit
```

## 🧠 More information
- Documentation for headers: https://docs.ntfy.sh/publish/#using-http
- This client uses Guzzle for HTTP requests, so you can use all Guzzle features.

## 📝 License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

