
public function delete<?php echo ucfirst($columnName) ?>()
{
	$this-><?php echo $columnName ?>AsArray = array();
	$this-><?php echo $columnName ?> = '';	
	$this->modifiedColumns[] = <?php echo ucfirst($tableName) ?>Peer::<?php echo strtoupper($columnName) ?>;	
}
