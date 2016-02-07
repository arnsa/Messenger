<?php
class Database {
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;

	private $dbh;
	private $error;
	private $stmt;

	///Database klasės konstruktorius (prisijungiama prie duomenų bazės)
	public function __construct() {
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		$options = array (
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);

		try {
			$this->dbh = new PDO ($dsn, $this->user, $this->pass, $options);
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
		}
	}

	///Paruošia sql užklausą
	public function query($query) {
		$this->stmt = $this->dbh->prepare($query);
	}

	///Suriša nurodytą reikšmę su nurodytu parametru
	public function bind($param, $value, $type = null) {
		if(is_null($type)) {
			switch(true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	///Įvykdo sql užklausą
	public function execute() {
		return $this->stmt->execute();
	}

	///Grąžina pasirinktus rezultatus iš duomenų bazės
	public function resultset() {
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}

	///Grąžina pasirinktą rezultatą iš duomenų bazės
	public function single() {
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_OBJ);
	}

	///Suskaičiuoja eilučių skaičių, kurias paveikė paskutinė įvykdyta sql užklausą
	public function rowCount() {
		return $this->stmt->rowCount();
	}

	///Grąžina paskutinio įterpto įrašo ID
	public function lastInsertId() {
		return $this->dbh->lastInsertId();
	}
}