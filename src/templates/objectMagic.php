/**
 * @param string $name   Method name.
 * @param array  $params Parameters.
 *
 * @return string
 */
public function __call($name, $params)
{
    $key = strtolower(ltrim(ltrim($name, 'get'), 'set'));
    $this->initExtraFieldsAsArray();
    switch (substr($name, 0, 3)) {
        case 'get':
            return $this-><?php echo $columnName ?>AsArray[$key];
        case 'set':
            $this->set<?php echo ucfirst($columnName) ?>(array($key => $params[0]));
            break;
        default:
            if (isset($this-><?php echo $columnName ?>AsArray[$key])) {
                return $this-><?php echo $columnName ?>AsArray[$key];
            } else {
                throw new Exception($this, 1);
            }
            break;
    }
}

public function __get($key)
{        
    $this->initExtraFieldsAsArray();    
    return isset($this-><?php echo $columnName ?>AsArray[$key])
        ? $this-><?php echo $columnName ?>AsArray[$key]
        : null;
}
    
public function __set($key, $value)
{
    $this-><?php echo $columnName ?>AsArray[$key] = $value;
    $this-><?php echo $columnNameUnderscore ?> = $this->getHstoreFormat($this-><?php echo $columnName ?>AsArray);
    $this->modifiedColumns[] = <?php echo ucfirst($tableName) ?>Peer::<?php echo strtoupper($columnNameUnderscore) ?>; 
}
