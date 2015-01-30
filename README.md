#Rest in PHP

wanna_be_something_someday_repository

> this repo is in hard dev


##Entity

you can define a model on ./models path as follow:
```
<?php
namespace ripModel;

class MyObject extends \Rip\Entity{

  /* TABLE FIELDS */
  public $id;       // <<- column `id` from database
  public $name;     // <<- column `name` from database
  public $email;    // <<- column `email` from database
  public $phone;    // <<- column `phone` from database

  public function __construct(){
    //parent::__construct( $tablename, $tableid);
    parent::__construct("test", "id");
  }

}
```
this class inherits some methods:

#### `->load( $id )`

Fill class's `TABLE FIELDS` with data fetched from db with `$tableid = $id`

#### `->loadBy( $field, $value )`

Fill class's `TABLE FIELDS` with data fetched from db with the first occurence of `$field = $value`

#### `->save(  )`

Save object data. it perform an UPDATE if `$tableid` is not empty. INSERT otherwise.

#### `->delete(  )`

Destroy object and delete database data.
