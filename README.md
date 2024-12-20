Для запуска выполнить команду 
```
docker-compose up --build
```
Если бы все работало, к API можно было бы обратиться по адресу  http://rbc-exchange-rate.devel/?date=YYYY-MM-DD&cy=CURRENCY_CODE&base=BASE_CURRENCY

А сейчас можно скопировать себе nginx.conf, настроить локальный доступ, поставить библиотеку xml и уже после запустить по адресу выше 

 