

    /**
     * Set the value of [<?php echo $columnName ?>] column.
     *
     * @param  array $array new value
     * @return The   current object (for fluent API support)
     */
    public function set<?php echo ucfirst($columnName) ?>(array $array = array())
    {

        if (is_array($array) && count($array) > 0) {

            $this-><?php echo $columnName ?>AsArray = $array;
            $this-><?php echo $columnName ?> = $this->getHstoreFormat($array);
            $this->modifiedColumns[] = <?php echo ucfirst($tableName) ?>Peer::<?php echo strtoupper($columnName) ?>;
        }

        return $this;
    }
