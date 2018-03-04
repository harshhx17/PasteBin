# PasteBin
A pastebin clone which has the follwing features:
1. User authentication(Login/Sign up)
2. Each paste has a unique generated link which can be publicly shared.
3. A simple dashboard for each user to see created pastes.
4. Corresponding to each paste on the dashboard there is a public/private toggle and delete option.

Setup Guide:
1) Clone or download the repository.
2) Create a mysql database with following tables:
```
CREATE TABLE `UserCredentials` (
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Paste` (
  `Id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Paste` text NOT NULL,
  `Private` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `currentIndex` (
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `currentIndex` (`count`) VALUES
(1);
```
3)Change the data about host, user, password and database name in mysql.php

4)You are good to go:wink:
