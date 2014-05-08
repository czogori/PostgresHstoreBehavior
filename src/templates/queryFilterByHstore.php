
    /**
     * Filter the query on the <?php echo $columnName ?> column
     *
     * Example usage:
     * <code>
     * $query->filterById('foo', 'bar'); // hstore -> 'foo' = 'bar'
     * $query->filterById('foo', '%ar'); // hstore -> 'foo' LIKE '%ar'
     * $query->filterById('foo', 123, Criteria::GREATER_EQUAL); // hstore -> 'foo' >= '123'
     * </code>
     *
     * @param string $key        Hstore key
     * @param string $value      Hstore value
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BookQuery The current query, for fluid interface
     */
    public function <?php echo $columnName ?>($key = null, $value = null, $comparison = null)
    {
        if (null === $comparison) {
            if (preg_match('/[\%\*]/', $value)) {
                $value = str_replace('*', '%', $value);
                $comparison = Criteria::LIKE;
            } else {
                $comparison = Criteria::EQUAL;
            }
        }

        return $this->where(sprintf("%s -> '%s' %s ?", <?php echo ucfirst($tableName) ?>Peer::<?php echo strtoupper($columnNameUnderscore) ?>, $key, $comparison), $value, PDO::PARAM_STR);
    }
