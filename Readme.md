#Rest in PHP

wanna_be_something_someday_repository

> hard dev

###Entity

you can define a model on ./models path as follow:
```
<?php
namespace ripModel;

class MyObject extends \rip\Entity{

  /* TABLE FIELDS */
  public $id;       // <<- column from database
  public $name;     // <<- column from database
  public $email;    // <<- column from database
  public $phone;    // <<- column from database

  public function __construct(){
    //parent::__construct( $tablename, $tableid);
    parent::__construct("test", "id");
  }

}
```
this class inherits some methods:

#### `->load( $id )`

Fill class's `TABLE FIELDS` with data fetched from db with `$tableid = $id`

#### `->save(  )`

Save object data. it perform an UPDATE if `$tableid` is not empty. INSERT otherwise.
