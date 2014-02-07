
public function delete<?php echo ucfirst($columnName) ?>()
{
    $this-><?php echo $columnName ?>AsArray = array();
    $this-><?php echo $columnNameUnderscore ?> = '';
    $this->modifiedColumns[] = <?php echo ucfirst($tableName) ?>Peer::<?php echo strtoupper($columnNameUnderscore) ?>;
}
