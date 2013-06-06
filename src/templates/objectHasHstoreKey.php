
public function has<?php echo ucfirst($columnName) ?>Key($key)
{
	return array_key_exists($key, $this->get<?php echo ucfirst($columnName) ?>());
}
