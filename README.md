commons
=======

Introduction
-------

This repository is a bag of the classes used in my other projects. The most important class is Registry. 
The class is inspired in the concept showed on martin's fowler book Patterns of Enterprise Application Architecture. 
The main reason for its existence is dependency injection, I need some place to put my dependencies and I dont' found
any good and plain implementation of this in PHP.

Requirements
-------

* Php version 5.3

Instalation
-------

You can use composer, see the composer file in the root of the project. Only version above 1.0.4 will be there.

Example of use
-------

```php
$top = new \hvasoares\commons\Registry();

$obj = new stdClass;

$top['someObject'] = $obj;

$obj == $top['someObject']; //will return true

$child = new \hvasoares\commons\Registry($top);

$child['someObject'] == $top['someObject]; //will return true

$newObj = new stdClass;

$child['someObject] = $newObj;

$child['someObject] == $top['someObject']; //will return false

$child['someObject] == $newObj; //will return true
```


