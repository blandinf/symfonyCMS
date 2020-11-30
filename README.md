
# symfonyCMS

SymfonyCMS is a Symfony 4 project. This project is a web marketplace like "Le bon coin".
Users can sell items. Visitors can find various items and contact the seller.
## Installation

Use php version and Symfony  

```bash
git clone https://github.com/blandinf/symfonyCMS.git

cd symfonyCMS/
composer install
```

## Usage


### Fixtures

Load fixtures 
```bash
php bin/console hautelook:fixtures:load
```

Load fixtures, db will don't be purged
```bash
php bin/console hautelook:fixtures:load --append
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)