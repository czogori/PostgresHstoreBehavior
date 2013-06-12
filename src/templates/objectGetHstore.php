

	/**
     * Get the <?php echo ucfirst($columnName) ?> column value.
     *
     * @return array|string
     */
	public function get<?php echo ucfirst($columnName) ?>($key = '')
	{
		if(empty($key) && $this-><?php echo $columnName ?>AsArray && is_array($this-><?php echo $columnName ?>AsArray)) {
			return $this-><?php echo $columnName ?>AsArray;
		} else {
			preg_match_all("/\"(.*)\"=>\"(.*)\"/", $this-><?php echo $columnName ?>, $items, PREG_SET_ORDER);
			
			$array = array();
			foreach($items as $item) {			
				$array[$item[1]] = $item[2];
			}

			$this-><?php echo $columnName ?>AsArray = $array;		
			if(!empty($key) && !array_key_exists($key, $out)) {
				throw new Exception(sprintf("The key %s doesn't exist.", $key));			
			}
			return empty($key) ? $array : $array[$key];
		}
	}