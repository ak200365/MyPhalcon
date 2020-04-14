
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(45) NOT NULL DEFAULT 'user',
  `password` char(32) NOT NULL,
  `is_active` tinyint(1) unsigned DEFAULT '1',
  `name` varchar(40) DEFAULT NULL,
  `balance` int(6) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

insert into `users` set `id`=1,  `login`='admin',    `password`='21232f297a57a5a743894a0e4a801fc3', `role`="admin", `email`='amberduke@pyrami.com',          `name`='Amber Duke',        `balance`=39225 ;
insert into `users` set `id`=2,  `login`='manager',  `password`='5df48102dd7d01e5c9c686d441c1d752', `role`='manager',  `email`='hattiebond@netagy.com',         `name`='Hattie Bond',       `balance`=5686  ;
insert into `users` set `id`=3,  `login`='user',     `password`='ee11cbb19052e40b07aac0ca060c23ee',             `email`='hattiebond@netagy.com',         `name`='Hattie Bond',       `balance`=5686  ;
insert into `users` set `id`=12, `login`='Quilty',   `password`='c4293c245240a24b3ace6f4b718896d1',     `email`='nanettebates@quility.com',      `name`='Nanette Bates',     `balance`=32838 ;
insert into `users` set `id`=13, `login`='Boink',    `password`='8b6709edf3c2df232d87cba65e980ea9',        `email`='daleadams@boink.com',           `name`='Dale Adams',        `balance`=4180  ;
insert into `users` set `id`=14, `login`='Scentric', `password`='4e3223bec5d905689632b6f097ded68d',    `email`='elinorratliff@scentric.com',    `name`='James Macevoy',     `balance`=16418 ;
insert into `users` set `id`=15, `login`='Filodyne', `password`='e0a49abba6216ed5bf5c6b396f12ca15',    `email`='virginiaayala@filodyne.com',    `name`='Virginia Ayala',    `balance`=40540 ;
insert into `users` set `id`=16, `login`='Quailcom', `password`='72b3fe3c7d3e33ef000724c6ea5ee859', `email`='dillardmcpherson@quailcom.com', `name`='Dillard Mcpherson', `balance`=48086 ;
insert into `users` set `id`=17, `login`='Reversus', `password`='83ef20880dfb338a978926742e295410',      `email`='mcgeemooney@reversus.com',      `name`='James Stone',       `balance`=18612 ;
insert into `users` set `id`=18, `login`='Orbalix',  `password`='1b0ef4ffd4ccc84c840cf5d923446438',   `email`='aureliaharding@orbalix.com',    `name`='Aurelia Harding',   `balance`=34487 ;
insert into `users` set `id`=19, `login`='Anoha',    `password`='e5f89e726037d451a465ef279d732d87',       `email`='fultonholt@anocha.com',         `name`='Fulton Holt',       `balance`=29104 ;
insert into `users` set `id`=20, `login`='Bezal',    `password`='51b919213003f77a06475f5a2e2d1962',     `email`='burtonmeyers@bezal.com',        `name`='Burton Meyers',     `balance`=14097 ;
insert into `users` set `id`=21, `login`='Emtrac',   `password`='e9a4b616e32b9077b64859cbb1b6d975',      `email`='josienelson@emtrac.com',        `name`='James Charles',     `balance`=14992 ;
insert into `users` set `id`=22, `login`='Valprel',  `password`='f50a9b641aaf0d9fb0a983997c5307e8',      `email`='hughesowens@valpreal.com',      `name`='Hughes Owens',      `balance`=6077  ;
insert into `users` set `id`=23, `login`='Evenex',   `password`='4f44010fa7e128c82c410f5dea90073a',          `email`='hallkey@eventex.com',           `name`='Hall Key',          `balance`=44214 ;
insert into `users` set `id`=24, `login`='Netplode', `password`='f23fec88a00b0bc58d1934804cb49142',   `email`='deidrethompson@netplode.com',   `name`='Deidre Thompson',   `balance`=38172 ;
