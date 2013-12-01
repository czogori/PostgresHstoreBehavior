<?php

/**
 * @author Arek Jaskólski <arek.jaskolski@gmail.com>
 */
class PostgresHstoreBehaviorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (!class_exists('Foo')) {
            $schema = <<<EOF
<database name="hstore_behavior" defaultIdMethod="native">
    <table name="foo">
        <column name="id" required="true" primaryKey="true" autoIncrement="true" type="INTEGER" />
        <column name="name" type="VARCHAR" required="true" />
        <column name="property" type="VARCHAR" required="true" />

        <behavior name="postgres_hstore">
            <parameter name="column_name" value="property" />
        </behavior>
    </table>
</database>
EOF;
            $builder = new PropelQuickBuilder();
            $config  = $builder->getConfig();
            $config->setBuildProperty('behavior.postgres_hstore.class', '../src/PostgresHstoreBehavior');
            $builder->setConfig($config);
            $builder->setSchema($schema);
            $builder->build();
        }
    }

    public function testObjectMethods()
    {
        $this->assertTrue(method_exists('Foo', 'getProperty'));
        $this->assertTrue(method_exists('Foo', 'setProperty'));
        $this->assertTrue(method_exists('Foo', 'getPropertyKeys'));
        $this->assertTrue(method_exists('Foo', 'hasPropertyKey'));
        $this->assertTrue(method_exists('Foo', 'getHstoreFormat'));
        $this->assertTrue(method_exists('Foo', '__call'));
        $this->assertTrue(method_exists('Foo', 'initExtraFieldsAsArray'));
    }

    public function testQueryMethods()
    {
        $this->assertTrue(method_exists('FooQuery', 'filterByProperty'));
    }

    public function testAccessMethods()
    {
        $foo = new Foo();
        $foo->setProperty(array('key' => 'value'));
        
        $this->assertEquals(array('key' => 'value'), $foo->getProperty());
        $this->assertEquals(array('key'), $foo->getPropertyKeys());
    }

    public function testMagicMethods()
    {
        $foo = new Foo();        
        $foo->setFoo('bar');

        $this->assertEquals('bar', $foo->getFoo());        
    }

    public function testHasMethod()
    {
        $foo = new Foo();
        $foo->setProperty(array('foo' => 'bar'));
        
        $this->assertTrue($foo->hasPropertyKey('foo'));
        $this->assertFalse($foo->hasPropertyKey('bar'));
    }

    public function testGetHstoreFormat()
    {
        $foo = new Foo();
        $array = array('foo' => 123, 'bar' => 'foobar');
        $this->assertEquals('"foo"=>"123","bar"=>"foobar"', $foo->getHstoreFormat($array));
    }

    public function testDeleteMethod()
    {
        $foo = new Foo();
        $foo->setProperty(array('foo' => 'boo', 'bar' => 'moo'));

        $this->assertEquals(array('foo' => 'boo', 'bar' => 'moo'), $foo->getProperty());
        $foo->deletePropertyKey('foo');
        $this->assertEquals(array('bar' => 'moo'), $foo->getProperty());

        $this->assertFalse($foo->hasPropertyKey('foo'));
        $this->assertCount(1, $foo->getProperty());
    }

    public function testDeleteAllMethod()
    {
        $foo = new Foo();
        $foo->setProperty(array('foo' => 'boo', 'bar' => 'moo'));

        $this->assertEquals(array('foo' => 'boo', 'bar' => 'moo'), $foo->getProperty());
        $foo->deleteProperty();
        $this->assertEquals(array(), $foo->getProperty());

        $this->assertFalse($foo->hasPropertyKey('foo'));
        $this->assertCount(0, $foo->getProperty());
    }
}
