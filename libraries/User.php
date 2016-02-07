<?php
class User {
	private $db;

	///Sukuriamas naujas duombazės objektas
	public function __construct() {
		$this->db = new Database();
	}

	///Patikrina, ar įvesta vartotojo informacija yra teisinga, ir jei taip, įterpia naują vartotoją į duomenų bazę
	public function register($data) {
		if($data['password'] != $data['repeat_password'])
			return array(false, 'Your passwords doesn\'t match!');

		$this->db->query('INSERT INTO users (name, second_name, username, email, password)
						VALUES (:name, :second_name, :username, :email, :password)');

		$this->db->bind(':name', $data['name']);
		$this->db->bind(':second_name', $data['second_name']);
		$this->db->bind(':username', $data['username']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':password', $data['password']);

		try {
			if ($this->db->execute())
				return array(true, 'Registration successful!');
			else
				return array(false, 'Username or email is already taken!');
		} catch(PDOException $e) {
			if ($e->getCode() == 23000)
				return array(false, 'Username or email is already taken!');
		}
	}

	///Patikrina, ar vartotojas suvedė teisingus duomenis, ir jei taip, grąžina true reikšmę
	public function login($data) {
		$this->db->query('SELECT * FROM users WHERE username = :username AND password = :password;');

		$this->db->bind(':username', $data['username']);
		$this->db->bind(':password', $data['password']);

		$this->db->execute();
		if($this->db->rowCount() == 1)
			return true;
		else
			return false;
	}

	///Atjungia vartotoją nuo sesijos (sunaikina sesiją) ir nukreipia į index.php failą
	public function logout($data) {
		unset($data);
		session_destroy();
		header('Location: index.php');
	}
}
