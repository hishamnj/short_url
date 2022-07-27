Db and table creation
---------------------
CREATE TABLE IF NOT EXISTS short_url (
 id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 url tinytext NOT NULL,
 short_url varchar(50) NOT NULL,
 count int(11) NOT NULL,
 created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

To Shorten url
--------------
http://localhost/short_url/?url=https://www.google.com
    OR
http://localhost/short_url


To redirect to tiny url:
------------------------
http://localhost/short_url/67c65a

#htaccess redirect is used to redirect tinyurl to actual url.