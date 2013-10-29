<?php

/**
 * @author Arek Jaskólski <arek.jaskolski@gmail.com>
 */
class PostgresHstoreBehaviorObjectBuilderModifier
{
    /**
     * @var PostgresHstoreBehavior
     */
    protected $behavior;

    public function __construct(Behavior $behavior)
    {
        $this->behavior = $behavior;
    }

    /**
     * {@inheritdoc}
     */
    public function objectAttributes($builder)
    {
        return $this->behavior->renderTemplate('objectAttributes', array(
            'columnName' => lcfirst($this->camelize($this->behavior->getParameter('column_name'))),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function objectMethods($builder)
    {        
        $script = $this->addGetHstoreKeys($builder);
        $script .= $this->addHasHstoreKey($builder);
        $script .= $this->addDeleteHstore($builder);
        $script .= $this->addDeleteHstoreKey($builder);
        $script .= $this->addGetHstoreFormat($builder);

        return $script;
    }

    /**
     * {@inheritdoc}
     */
    public function objectFilter(&$script)
    {
        $columName = $this->camelize($this->behavior->getParameter('column_name'));
        $parser = new PropelPHPParser($script, true);
        $parser->replaceMethod('get' . $columName, $this->addGetHstore());        
        $parser->replaceMethod('set' . $columName, $this->addSetHstore());        
        $script = $parser->getCode();            
    }

    private function addGetHstore()
    {
        return $this->behavior->renderTemplate('objectGetHstore', $this->getTemplateData());
    }

    private function addSetHstore()
    {
        return $this->behavior->renderTemplate('objectSetHstore', $this->getTemplateData());
    }
    
    private function addGetHstoreKeys()
    {
        return $this->behavior->renderTemplate('objectGetHstoreKeys', $this->getTemplateData());
    }

    private function addHasHstoreKey()
    {
        return $this->behavior->renderTemplate('objectHasHstoreKey', $this->getTemplateData());
    }

    private function addDeleteHstore()
    {
        return $this->behavior->renderTemplate('objectDeleteHstore', $this->getTemplateData());
    }

    private function addDeleteHstoreKey()
    {
        return $this->behavior->renderTemplate('objectDeleteHstoreKey', $this->getTemplateData());
    }

    private function addGetHstoreFormat()
    {
        return $this->behavior->renderTemplate('objectGetHstoreFormat', $this->getTemplateData());
    }

    private function getTemplateData()
    {        
        return array(
            'tableName' => $this->behavior->getTable()->getName(),
            'columnName' => lcfirst($this->camelize($this->behavior->getParameter('column_name'))),
        );
    }

    private function camelize($string) 
    {
        return ucfirst(str_replace(' ', '', ucwords(strtr($string, '_-', '  '))));
    }
}