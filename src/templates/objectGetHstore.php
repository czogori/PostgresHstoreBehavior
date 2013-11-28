

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
        $this->initExtraFieldsAsArray();
        if (!empty($key) && !array_key_exists($key, $this-><?php echo $columnName ?>AsArray)) {
            throw new Exception(sprintf("The key %s doesn't exist.", $key));
        }

        return empty($key) ? $this-><?php echo $columnName ?>AsArray : $this-><?php echo $columnName ?>AsArray[$key];
    }
}
