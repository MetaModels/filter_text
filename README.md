[![Build Status](https://travis-ci.org/MetaModels/filter_text.svg)](https://travis-ci.org/MetaModels/filter_text)
[![Latest Version tagged](http://img.shields.io/github/tag/MetaModels/filter_text.svg)](https://github.com/MetaModels/filter_text/tags)
[![Latest Version on Packagist](http://img.shields.io/packagist/v/MetaModels/filter_text.svg)](https://packagist.org/packages/MetaModels/filter_text)
[![Installations via composer per month](http://img.shields.io/packagist/dm/MetaModels/filter_text.svg)](https://packagist.org/packages/MetaModels/filter_text)

Text filter
===========

MetaModels text filter with fulltext support.

useage for fulltext filter

1. Add a fulltext-index to all columns of your metamodel-table. You have to login to your database-server or use a tool e.g. phpmyadmin to solve this step.
mysql> ALTER TABLE `mm_mytable` ADD FULLTEXT(`my_fency_column`);
optional add more fulltext indexes to columns
mysql> ALTER TABLE `mm_mytable` ADD FULLTEXT(`my_foobar_column`);
mysql> ALTER TABLE `mm_mytable` ADD FULLTEXT(`my_super_important_column`);


2. on contao-backend, create a text-filter with searchtype "fulltextsearch (SQL-Against)"

3. optional: add other columns, comma seperated to fulltext search:
Filtersetting "extendFields": my_foobar_columns,my_super_importan_column

 
