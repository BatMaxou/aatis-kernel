# Aatis Kernel

## Advertisement

This package is a part of `Aatis` and can't be used without the following packages :

- `aatis/dependency-injection` (https://github.com/BatMaxou/aatis-dependency-injection)
- `aatis/http-foundation` (https://github.com/BatMaxou/aatis-http-foundation)
- `aatis/routing` (https://github.com/BatMaxou/aatis-routing)
- `aatis/logger` (https://github.com/BatMaxou/aatis-logger)
- `aatis/error-handler` (https://github.com/BatMaxou/aatis-error-handler)

## Installation

```bash
composer require aatis/kernel
```

## Usage

### Requirements

Initialize `Aatis` packages (**see the README of each package**)

### Basic usage

If needed, create a kernel class and extend the `Aatis Kernel` :

```php
use Aatis\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    public function handle(): void
    {
        // extra process
        parent::handle();
        // extra process
    }
}
```

Or use it directly :

```php
(new Kernel())->handle();
```
