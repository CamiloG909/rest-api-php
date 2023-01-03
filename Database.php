<?php

class Database {
	private $host;
	private $user;
	private $password;
	private $name;
	private $schema;
	private $port;
	private $connection;

	public function connect($ENV) {
		$this->connection = null;
		$this->host = $ENV['DB_HOST'];
		$this->user = $ENV['DB_USER'];
		$this->password = $ENV['DB_PASS'];
		$this->name = $ENV['DB_NAME'] == '' ? 'public' : $ENV['DB_NAME'];
		$this->schema = $ENV['DB_SCHEMA'];
		$this->port = $ENV['DB_PORT'];

		try {
			$this->connection = new PDO("pgsql:host=$this->host;port=$this->port;dbname=$this->name",$this->user,$this->password);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo "Error in the connection with db: " . $e->getMessage();
		}

		return ['connection' => $this->connection, 'schema' => $this->schema ];
	}
}

?>
