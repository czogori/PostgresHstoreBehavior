
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
