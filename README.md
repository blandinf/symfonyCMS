
# symfonyCMS  
  
SymfonyCMS is a Symfony 4 project. This project is a web marketplace like "Le bon coin".  
Users can sell items. Visitors can find various items and contact the seller.  
## Installation  
  
At least, use 7.3 php version, 5.1.8 Symfony version and 2.0.7 Composer version
  
```bash  
git clone https://github.com/blandinf/symfonyCMS.git  
  
cd symfonyCMS/  
composer install  
``` 

```bash  
php bin/console doctrine:schema:update --force
``` 
  
## Usage  
  
### Start

Start server
```bash  
symfony server:start 
```  
or
```bash  
php -S localhost:8000 -t public
``` 

### Fixtures  
  
Load fixtures   
```bash  
php bin/console hautelook:fixtures:load  
```  
  
Load fixtures, database won't be purged  
```bash  
php bin/console hautelook:fixtures:load --append  
```  
  
## Features
* Send mail - SwiftMailer
* Doctrine ORM
* authentification
* admin/user
* CRUD
* Forms & media upload
* Should can't crud offers (use voter)
* [API Platfom](https://api-platform.com/)
* only admin should crud category -> api?
* validation formulaire
* Traductions
* Admin can update categories
* Fixtures - Hautelook Alice
* Slug

## WIP Features  
* my offers
* [composant Workflow](https://symfony.com/doc/current/workflow.html)

## Contributing  
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.  
  
Please make sure to update tests as appropriate.  

Made by [@juliette-bois](https://github.com/juliette-bois) [@blandinf](https://github.com/blandinf) [@vandevey](https://github.com/vandevey)
  
## License  
[MIT](https://choosealicense.com/licenses/mit/)
