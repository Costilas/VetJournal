up:	artisan own chmod

artisan:
	docker exec journal_php-fpm_1 $(COM)

own:
	docker exec journal_php-fpm_1 chown 1000:1000 -R ./

chmod:
	chmod 777 -R ./app
