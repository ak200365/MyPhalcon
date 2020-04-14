# MyPhalcon
My First Phalcon

----------------------------------------------------------------------------------

	$ git clone https://github.com/ak200365/MyPhalcon.git
	$ cd MyPhalcon
	$ docker-compose up --build

	После загрузки образов и запуска контейнера сайт будет доступен на localhost:8080
	(в Windows-е на 192.168.99.100:8080)

----------------------------------------------------------------------------------

Установка docker: https://docs.docker.com/install/
Установка docker-compose: https://docs.docker.com/compose/install/

Небольшой индекс (база) users подгружается автоматически из ./bin/mvc_dump.sql

В Windows-е для VM надо предоставить 2G (тестировалось с 4G), иначе phalcon не инсталлируется.
