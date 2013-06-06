<?php

/**
 * @author Arek Jaskólski <arek.jaskolski@gmail.com>
 */
class PostgresHstoreBehavior extends Behavior
{
    /**
     * @var PostgresHstoreBehaviorObjectBuilderModifier
     */
    private $objectBuilderModifier;

    /**
     * @var PostgresHstoreBehaviorQueryBuilderModifier
     */
    private $queryBuilderModifier;      

    /**
     * {@inheritdoc}
     */
    public function getObjectBuilderModifier()
    {
      if (is_null($this->objectBuilderModifier))
      {
        $this->objectBuilderModifier = new PostgresHstoreBehaviorObjectBuilderModifier($this);
      }
      return $this->objectBuilderModifier;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryBuilderModifier()
    {
        if (null === $this->queryBuilderModifier) {
            $this->queryBuilderModifier = new PostgresHstoreBehaviorQueryBuilderModifier($this);
        }

        return $this->queryBuilderModifier;
    }
}
