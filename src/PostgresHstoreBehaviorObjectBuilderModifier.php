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
        $script = '';
        $templates = array(
            'objectGetHstoreKeys',
            'objectHasHstoreKey',
            'objectDeleteHstore',
            'objectDeleteHstoreKey',
            'objectGetHstoreFormat',
            'objectMagic',
            'objectPrivate',      
        );
        foreach ($templates as $template) {
            $script .= $this->behavior->renderTemplate($template, $this->getTemplateData());
        }

        return $script;
    }

    /**
     * {@inheritdoc}
     */
    public function objectFilter(&$script)
    {
        $columName = ucfirst($this->camelize($this->behavior->getParameter('column_name')));
        $parser = new PropelPHPParser($script, true);
        $parser->replaceMethod('get' . $columName, $this->behavior->renderTemplate('objectGetHstore', $this->getTemplateData()));
        $parser->replaceMethod('set' . $columName, $this->behavior->renderTemplate('objectSetHstore', $this->getTemplateData()));
        $script = $parser->getCode();
    }   

    private function getTemplateData()
    {
        return array(
            'tableName' => $this->behavior->getTable()->getName(),
            'columnName' => $this->camelize($this->behavior->getParameter('column_name')),
            'columnNameUnderscore' => $this->behavior->getParameter('column_name'),
        );
    }

    private function camelize($string)
    {
        return lcfirst(str_replace(' ', '', ucwords(strtr($string, '_-', '  '))));
    }
}
