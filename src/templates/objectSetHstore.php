

    /**
     * Set the value of [<?php echo $columnName ?>] column.
     *
     * @param  array   $array New key-value elements.
     * @param  boolean $merge If true new key-value elements is merging with old array otherwise old value is overwrite.
     *
     * @return The current object (for fluent API support)
     */
    public function set<?php echo ucfirst($columnName) ?>(array $array = array(), $merge = true)
    {
        if (is_array($array) && count($array) > 0) {
            $this-><?php echo $columnName ?>AsArray = $merge ? array_merge((array) $this-><?php echo $columnName ?>AsArray, $array) : $array;
            $this-><?php echo $columnNameUnderscore ?> = $this->getHstoreFormat($this-><?php echo $columnName ?>AsArray);
            $this->modifiedColumns[] = <?php echo ucfirst($tableName) ?>Peer::<?php echo strtoupper($columnNameUnderscore) ?>;
        }

        return $this;
    }
