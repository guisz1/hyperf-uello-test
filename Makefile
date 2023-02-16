up:
	docker-compose up
down:
	docker-compose down
php:
	docker exec -it uello-php bash
db:
	docker exec -it uello-db mysql -uroot -psecret uello
migrate:
	docker container exec -it uello-php php bin/hyperf.php migrate
install:
	docker container exec -it uello-php composer install
reset:
	docker container exec -it uello-php php bin/hyperf.php migrate:reset
migration:
	docker container exec -it uello-php php bin/hyperf.php gen:migration $(name)
tests:
	docker container exec -it uello-php php vendor/bin/co-phpunit --prepend=test/bootstrap.php 
