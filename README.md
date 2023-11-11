# Aatis Kernel

## Installation

```bash
composer require aatis/kernel
```

## Usage

Create your kernel class and extend the `Aatis Kernel` :

```php
use Aatis\Kernel as BaseKernel;

class YourKernel extends BaseKernel
{
    public function handle(): void
    {
        // Your extra stuff
        parent::handle();
        // Your extra stuff
    }
}
```

Or use it directly into your code :

```php
(new Kernel())->handle();
```
