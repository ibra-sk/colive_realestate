<?php

class DBlite
{
	
	public function __construct() {
		
	}
	
	public static function connect($dir){
		$sqldb = new PDO($dir) or die("cannot open the database");
		return $sqldb;
	}
	
	public static function read($query){
		$pdo = $this->sqldb;
		$data = $pdo->query($query);
		return $data;
	}

  public static function write($query, $params = array())
  {
    $statement = self::connect()->prepare($query);
    $data = $statement->execute($params);
	return $data;
  }

  public static function result($query, $params = array())
  {
    $statement = self::connect()->prepare($query);
    $statement->execute($params);
    if (explode(' ', $query)[0] == 'SELECT')
    {
      $data = $statement->fetchAll(PDO::FETCH_ASSOC);
      if(isset($data[0]))
      {
        return $data[0];
      } else {
        return $data;
      }
    }
  }

  

}
?>
