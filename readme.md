###Features
* Products
* Categories
* Filters/Options/OptionGroups


### Общие принципы

Взаимодействие с пакетом ecommerce реализовано через сущность Ecommerce, которая по сути является фасадом не в понятии Laravel, а в понятии паттерна проектирования фасад.
Таким образом, корректный доступ ко всем функциям пакета должен выполняться через фасад Ecommerce.


### Подключение

1. Для установки пакета необходимо добавить в файл `composer.json` свойству
 ``` 
require: {
    ...
    "webmagic/ecommerce-light": "dev-dev"
    ...
}
 ```
2. Необходимо указать репозиторий проекта
```
 "repositories":[
     ...   
     {
        "type":"vcs",
         "url":"https://bitbucket.org/webmagic/ecommerce-light"
      } 
     ...
  ]
```
3. Далее необходимо обновить зависимости проекта, для чего нужно запустить в консоли команду `composer update`  
  
4. Пакет модет быть использован как самостоятельно, так и вместе с админкой. Для подключения пакета без админки необходимо прописать в фале `config/app.php`:
     ``` 
     providers => [
        ...
        Webmagic\EcommerceLight\EcommerceServiceProvider::class;
        ...
     ]
     ``` 
  
     
5. Далее необходимо подготовить базу данных. Для этого сначала необходимо выполнить команду `php artisan vendor:publish --provider=LaravelComponents\Ecommerce\EcommerceServiceProvider --tag=migrations` 

    Затем запустите в консоли команду `php artisan migrate`, которая применит миграции и создатс все необходимые для работы пакета таблицы 

После выполнения всего вышеперечисленного пакет будет готов к работе. 

### Настройка


### Integration with dashboard
 Include EcommerceDashboardServiceProvider in app file, if you included EcommerceServiceProvider, remove it.
 Should be include only one provider
 
 ``` 
      providers => [
         ...
         Webmagic\EcommerceLight\EcommerceDashboardServiceProvider::class;
         ...
      ]
      ``` 
 
