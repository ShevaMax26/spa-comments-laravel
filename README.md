## <h2 style="color:#ba363f">Installation</h2>
``` 
    composer install
    php artisan app:install
```

## Refresh data
``` 
    php artisan app:refresh
```


## Dev tips
```
docker-compose build --no-cache
docker-compose up --build --force-recreate --no-deps
docker-compose up -d --build

docker-compose down

docker-compose up -d

docker exec -it spa_comments_laravel_app bash

//не заходячи в bash, просто в папці проекту перший раз дати пермішини
chmod -R 777  ./

systemctl restart docker
```
