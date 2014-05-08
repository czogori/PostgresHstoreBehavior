<?php

/**
 * @author Arek Jaskólski <arek.jaskolski@gmail.com>
 */
class PostgresHstoreBehaviorQueryBuilderModifier
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
    public function queryFilter(&$script)
    {
        $parser = new PropelPHPParser($script, true);
        $parser->replaceMethod($this->getCamelizedColumnName(), $this->addQueryFilterByHstore());
        $script = $parser->getCode();
    }

    private function addQueryFilterByHstore()
    {
        return $this->behavior->renderTemplate('queryFilterByHstore', array(
            'tableName' => $this->behavior->getTable()->getName(),
            'columnName' => $this->getCamelizedColumnName(),
            'columnNameUnderscore' => $this->behavior->getParameter('column_name'),
        ));
    }

    private function getCamelizedColumnName()
    {
        $p = new PhpNameGenerator();
        return 'filterBy' . $p->generateName(array(
            $this->behavior->getParameter('column_name'),
            PhpNameGenerator::CONV_METHOD_PHPNAME));
    }
}
