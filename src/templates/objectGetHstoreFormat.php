
/**
 * Return string in hstore format
 *
 * @return string
 */
public function getHstoreFormat(array $array = array())
{
    $hstore = '';
    foreach ($array as $key => $value) {
        $hstore .= sprintf('"%s"=>"%s",', $key, $value);
    }
    $hstore = trim($hstore, ',');

    return $hstore;
}
