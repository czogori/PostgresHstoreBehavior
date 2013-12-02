PostgresHstoreBehavior
======================
[![Build Status](https://travis-ci.org/czogori/PostgresHstoreBehavior.png?branch=master)](https://travis-ci.org/czogori/PostgresHstoreBehavior)
[![Latest Stable Version](https://poser.pugx.org/czogori/propel-postgres-hstore-behavior/v/stable.png)](https://packagist.org/packages/czogori/propel-postgres-hstore-behavior)

Storage of key-value items using Postgres hstore.
## Installation 

First of all you have to install postgresql-contrib and create hstore extension.

```sql
CREATE EXTENSION hstore;
```

After that download code using composer:
```js
{
    "require": {        
        "czogori/propel-postgres-hstore-behavior": "dev-master"
    }
}
```
And put undermentioned entry to your `propel.ini` or `build.properties` configuration
file:
```ini
propel.behavior.hstore.class = path.to.PostgresHstoreBehavior
```
## Usage
Table definition - `schema.xml` file:
```xml
<table name="book" phpName="Book">    
    	<column name="id" type="integer" required="true" primaryKey="true" autoIncrement="true"/>
    	<column name="title" type="varchar" size="255" required="true" />
    	<column name="extra_parameters" type="varchar" required="false" />    
    	<behavior name="hstore">
    		<parameter name="column_name" value="extra_parameters" />     	
    	</behavior>
</table>
```

Now you can use hstore behavior.

```php
$book = new Book();
$book->setTitle('Foo and Bar');
// you can set params as array
$book->setExtraParameters(array('language' => 'polish'));
// or like this
$book->setLanguage('polish');
$book->save();

echo $book->getLanguage();
echo $book->getExtraParameters('language'); 
```
