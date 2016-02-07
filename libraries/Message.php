<?php
class Message {
	private $db;

	///Sukuriamas naujas duombazės objektas
	public function __construct() {
		$this->db = new Database();
	}

	///Įterpia naują žinutę į duomenų bazę (messages lentelė)
	public function sendMessage($data) {
		$this->db->query('INSERT INTO messages (username, message, time)
						VALUES (:username, :message, :time)');

		$this->db->bind(':username', $data['username']);
		$this->db->bind(':message', $data['message']);
		$this->db->bind(':time', $data['time']);

		$this->db->execute();
	}

	///Paima visas žinutes iš duomenų bazės (messages lentelės)
	public function getMessages() {
		$this->db->query('SELECT * FROM messages ORDER BY id DESC');

		return $this->db->resultset();
	}
}