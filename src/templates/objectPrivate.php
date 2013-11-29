/**
 * Convert hstore string to array and initialize <?php echo $columnName ?>AsArray variable.
 *
 * @return void
 */
private function initExtraFieldsAsArray()
{
    if (null === $this-><?php echo $columnName ?>AsArray) {
        $hstore = str_replace('"', '', $this-><?php echo $columnNameUnderscore ?>);
        $pairs = explode(',', $hstore);
        $array = array();
        foreach ($pairs as $pair) {
            $items = explode('=>', $pair);
            $array[$items[0]] = $items[1];
        }
        $this-><?php echo $columnName ?>AsArray = $array;
    }
}
