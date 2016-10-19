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

**4. Abstracts relationships:**
Create a generic InvoiceBundle able to work both with User and Company entities.
No code change or special configuration is needed for the bundle.

Define an abstract 'subject' interface
```php
namespace App\InvoiceBundle\Model;

interface InvoiceSubjectInterface
{
}
```

```php
 use Doctrine\ORM\Mapping as ORM; 
 use App\InvoiceBundle\Model\InvoiceSubjectInterface; 
 
 /** @ORMEntity */ 
 class User implements InvoiceSubjectInterface 
 { 
    // ... 
 } 
 
 /** @ORMEntity */ 
 class Company implements InvoiceSubjectInterface 
 { 
    // ... 
 } 
```

```php
Configure the entity association namespace App\InvoiceBundle\Entity; 

use Doctrine\ORM\Mapping AS ORM; 
use App\InvoiceBundle\Model\InvoiceSubjectInterface;
 
/** @ORMEntity */ 
class Invoice { 

    /** 
    * @ORMManyToOne( targetEntity="App\InvoiceBundle\Model\InvoiceSubjectInterface") 
    */ 
    protected $subject; 
} 
```

```php
Define the target entity (at each application) 
# app/config/config.yml 

doctrine: # ... 
    orm: # ... 
        resolve_target_entities: 
            App\InvoiceBundle\Model\InvoiceSubjectInterface: 
            Acme\AppBundle\Entity\Customer 
            #this is where magic happens: dynamic entity resolution at runtime 
```

