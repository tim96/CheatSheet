# Symfony tips

**1. Using console shortcuts:**
```
alias dev = php app/console --env=dev
alias prod = php app/console --env=prod
```

Using:
```
dev ...
prod ...
```

**2. Better log message:**
```php
// It doesn't work unless the PSR log processor is enabled
$logger->info("Order {id}, time {time}", ['id' => $id, 'time' => $time]);
```

**3. Mailer service:**
Amazaon, Mailgun, Postmark or using your own mailer.



