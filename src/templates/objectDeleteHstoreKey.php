
public function delete<?php echo ucfirst($columnName) ?>Key($key)
{
    $array = $this->get<?php echo ucfirst($columnName) ?>();
    if (array_key_exists($key, $array)) {
        unset($this-><?php echo $columnName ?>AsArray[$key]);
        $this-><?php echo $columnNameUnderscore ?> = $this->getHstoreFormat($this-><?php echo $columnName ?>AsArray);
        $this->modifiedColumns[] = <?php echo ucfirst($tableName) ?>Peer::<?php echo strtoupper($columnNameUnderscore) ?>;

        return true;
    } else {
        return false;
    }
}
