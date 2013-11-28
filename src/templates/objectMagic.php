
/**
 * @param string $name   Method name.
 * @param array  $params Parameters.
 * 
 * @return string
 */
public function __call($name, $params)
{                
    $key = strtolower(ltrim(ltrim($name, 'get'), 'set'));
    if(null === $this-><?php echo $columnName ?>AsArray) {
        $hstore = str_replace('"', '', $this-><?php echo $columnName ?>);
        $pairs = explode(',', $hstore);
        $array = array();
        foreach ($pairs as $pair) {
            $items = explode('=>', $pair);
            $array[trim($items[0])] = trim($items[1]);
        }
        $this-><?php echo $columnName ?>AsArray = $array;            
    }    

    switch (substr($name, 0, 3)) {
        case 'get':                
            return $this-><?php echo $columnName ?>AsArray[$key];
        case 'set':                
            $this-><?php echo $columnName ?>AsArray[$key] = $params[0];                 
            break;               
        default:                
            if(isset($this-><?php echo $columnName ?>AsArray[$key])) {
                return $this-><?php echo $columnName ?>AsArray[$key];
            } else {                    
                throw new Exception($this, 1);                                    
            }
            break;
    }
}