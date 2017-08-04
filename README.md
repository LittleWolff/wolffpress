[![Build Status](https://travis-ci.org/Automattic/_s.svg?branch=master)](https://travis-ci.org/Automattic/_s)

Instructions
---------------

* Download Wordpress
* Make a new directory for your project
* Copy Wordpress files to your new directory
* Start a mamp or vagrant server
* Make a new database
* connect to localhost (or scotchbox)
* fill in credentials to setup wordpres (root root for database)
* once set up open ruby command prompt
* cd to your directory
* cd wp-content/themes
* git clone https://github.com/LittleWolff/wolffpress.git
* Log into wordpress's backend (http://localhost/wp-admin or may have an extension based on port for instance if you use port 3000 your path will be http://localhost:3000/wp-admin)
* click appearance
* Set Wolff Press as the new theme
* click plugins
* install advanced custom fields pro and activate it
* click custom fields
* click tools
* under Import Field Groups click "choose file" and locate "acf-export-wolffpress.json" in the wolffpress theme folder.
* click import.

That's it for the setup! 
---------------

To begin developing always make sure your server is running then cd into the wolffpress theme:

cd <YourDirectory>wp-content/themes/wolffpress

Then run the command:

* sass --watch sass/style.scss:style.css
