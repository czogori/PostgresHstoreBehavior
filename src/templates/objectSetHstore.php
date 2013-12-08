

    /**
     * Set the value of [<?php echo $columnName ?>] column.
     *
     * @param  array $array new value
     * @return The   current object (for fluent API support)
     */
    public function set<?php echo ucfirst($columnName) ?>(array $array = array())
    {

        if (is_array($array) && count($array) > 0) {

            $this-><?php echo $columnName ?>AsArray = array_merge((array) $this-><?php echo $columnName ?>AsArray, $array);
            $this-><?php echo $columnNameUnderscore ?> = $this->getHstoreFormat($this-><?php echo $columnName ?>AsArray);
            $this->modifiedColumns[] = <?php echo ucfirst($tableName) ?>Peer::<?php echo strtoupper($columnNameUnderscore) ?>;
        }

        return $this;
    }
