up:
	docker-compose up
down:
	docker-compose down
php:
	docker exec -it uello-php bash
db:
	docker exec -it uello-db mysql -uroot -psecret 
