php - demoer
============

This project is able to show and excecute snippets.
The script will wait user press "enter" to show the result.
Put your snippet in `snippets/` folder.

![Demo](http://img19.imageshack.us/img19/1644/demoer.jpg)

Installation
------------

*  `git clone https://github.com/lyrixx/demoer.git`
*  `cd demoer`
*  `wget http://getcomposer.org/composer.phar`
*  `php composer.phar install`

Usage
-----

* list all snippets :  `php run.php list-snippets`
* run one snippet :  `php run.php run 001-HelloWorld.php`
* run all snippet : `php run.php run`

Requirements
------------

* php-5.3.2
