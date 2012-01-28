<?php
/**
 *  Hello world demo
 */

function sayHello($name = 'World') {
     printf('Hello %s !', $name);
}

sayHello();
echo PHP_EOL;
sayHello('Paris');
