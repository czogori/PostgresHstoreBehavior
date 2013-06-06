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
        $columnName = ucfirst($this->behavior->getParameter('column_name'));
        $parser = new PropelPHPParser($script, true);
        $parser->replaceMethod('filterBy'.$columnName, $this->addQueryFilterByHstore());                
        $script = $parser->getCode();    
    }

    private function addQueryFilterByHstore()
    {
        return $this->behavior->renderTemplate('queryFilterByHstore', array(
            'tableName' => $this->behavior->getTable()->getName(),
            'columnName' => $this->behavior->getParameter('column_name'),
        ));
    }
}