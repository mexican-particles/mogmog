test:
	docker-compose run --rm mogmog sh -c "phpunit -dmemory_limit=1G"
.PHONY: test

phpcs:
	docker-compose run --rm mogmog sh -c "phpcs ./src --standard=PSR12"
.PHONY: test

phpcbf:
	docker-compose run --rm mogmog sh -c "phpcbf ./src --standard=PSR12"
.PHONY: test

phpstan:
	docker-compose run --rm mogmog sh -c "phpstan analyse -c ./phpstan.neon"
.PHONY: test

pre-commit:
	docker-compose run --rm mogmog sh -c "phpcs ./src --standard=PSR12 && phpstan analyse -c ./phpstan.neon"
.PHONY: test
