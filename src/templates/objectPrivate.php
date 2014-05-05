/**
 * Convert hstore string to array and initialize <?php echo $columnName ?>AsArray variable.
 *
 * @return void
 */
private function initExtraFieldsAsArray()
{
    if (null === $this-><?php echo $columnName ?>AsArray && null !== $this-><?php echo $columnNameUnderscore ?>) {
        @eval(sprintf("\$hstore = array(%s);", $this-><?php echo $columnNameUnderscore ?>));

        if (!isset($hstore) ||  !is_array($hstore)) {
            throw new Exception(sprintf("Could not parse hstore string '%s' to array.", $this-><?php echo $columnNameUnderscore ?>));
        }
        $this-><?php echo $columnName ?>AsArray = $hstore;
    }
}
