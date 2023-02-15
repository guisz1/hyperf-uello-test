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
migration:
	docker container exec -it uello-php php bin/hyperf.php gen:migration $(name)

