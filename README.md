# Patchy2
-----------------------------------------------------

Upgrading:


You should update your database to have 2 new columns


	`lastLoginIP` varchar(15) NOT NULL,
	`lastLoginDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

	
You can add these using PHPMyAdmin or running install.php with a new database


These columns aren't going to be used until patchy 3.2 (earliest)