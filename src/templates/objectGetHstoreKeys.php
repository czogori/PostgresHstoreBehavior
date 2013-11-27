
public function get<?php echo ucfirst($columnName) ?>Keys()
{
    return array_keys($this->get<?php echo ucfirst($columnName) ?>());
}
