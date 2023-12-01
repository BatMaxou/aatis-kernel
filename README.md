# Aatis Kernel

## Installation

```bash
composer require aatis/kernel
```

## Usage

### Requirements

First, inform the router class :

```yaml
# In config/services.yaml file :

include_services:
    - 'Aatis\Routing\Service\Router'
```

Then, create your kernel class and extend the `Aatis Kernel` :

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
