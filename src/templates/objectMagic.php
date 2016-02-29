/**
 * @param string $name   Method name.
 * @param array  $params Parameters.
 *
 * @return string
 */
public function __call($name, $params)
{
    $key = ltrim(ltrim($name, 'get'), 'set');
    $this->initExtraFieldsAsArray();
    switch (substr($name, 0, 3)) {
        case 'get':
            $virtualColumn = ltrim($name, 'get');
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
            if (isset($this-><?php echo $columnName ?>AsArray[$key])) {
                return $this-><?php echo $columnName ?>AsArray[$key];
            } else {
                <?php echo $throwExceptionIfKeyNotExists ? 'throw new Exception(sprintf("Hstore key %s does not exist.", $key));' : 'return null;'; ?>
            }
        case 'set':
            if (isset($params[0])) {
                $this->set<?php echo ucfirst($columnName) ?>(array($key => $params[0]));
            }
            break;
        default:
            if (preg_match('/^from(\w+)$/', $name, $matches)) {
                return $this->importFrom($matches[1], reset($params));
            }
            if (preg_match('/^to(\w+)$/', $name, $matches)) {
                $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;
                return $this->exportTo($matches[1], $includeLazyLoadColumns);
            }
            throw new Exception(sprintf('Method %s does not exist.', $name));
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
