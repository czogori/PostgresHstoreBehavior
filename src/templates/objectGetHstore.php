

    /**
     * Get the <?php echo ucfirst($columnName) ?> column value.
     *
     * @return array|string
     */
    public function get<?php echo ucfirst($columnName) ?>($key = '')
    {
        if (empty($key) && $this-><?php echo $columnName ?>AsArray && is_array($this-><?php echo $columnName ?>AsArray)) {
            return $this-><?php echo $columnName ?>AsArray;
        } else {
            $hstore = str_replace('"', '', $this-><?php echo $columnName ?>AsArray);
            $pairs = explode(',', $hstore);
            $array = array();
            foreach ($pairs as $pair) {
                $items = explode('=>', $pair);
                $array[$items[0]] = $items[1];
            }

            $this-><?php echo $columnName ?>AsArray = $array;
            if (!empty($key) && !array_key_exists($key, $out)) {
                throw new Exception(sprintf("The key %s doesn't exist.", $key));
            }

            return empty($key) ? $array : $array[$key];
        }
    }
