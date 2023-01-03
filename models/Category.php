<?php

class Category {
	private $table = 'category';
	private $connection;
	private $connection_schema;

	public $id;
	public $name;
	public $creation_date;

	public function __construct($db) {
		$this->connection = $db['connection'];
		$this->connection_schema = $db['schema'];
	}

	public function getCategories() {
		$query = "SELECT * FROM $this->connection_schema.$this->table ORDER BY creation_date DESC;";

		$statement = $this->connection->prepare($query);
		$statement->execute();
		return $statement;
	}

	public function getCategory() {
		$query = "SELECT * FROM $this->connection_schema.$this->table WHERE id = ? LIMIT 1;";

		$statement = $this->connection->prepare($query);
		$statement->bindParam(1, $this->id);
		$statement->execute();

		$category = $statement->fetch(PDO::FETCH_ASSOC);

		$this->id = $category['id'];
		$this->name = $category['name'];
		$this->creation_date = $category['creation_date'];
	}

	public function addCategory() {
		$query = "INSERT INTO $this->connection_schema.$this->table (name) VALUES (?);";

		$this->name = htmlspecialchars(strip_tags($this->name));

		$statement = $this->connection->prepare($query);
		$statement->bindParam(1, $this->name);

		if($statement->execute()) {
			return true;
		}

		printf('Error: ', $statement->error);
		return false;
	}

	public function updateCategory() {
		$query = "UPDATE $this->connection_schema.$this->table SET name = ? WHERE id = ?;";

		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->name = htmlspecialchars(strip_tags($this->name));

		$statement = $this->connection->prepare($query);
		$statement->bindParam(1, $this->name);
		$statement->bindParam(2, $this->id);

		if($statement->execute()) {
			return true;
		}

		printf('Error: ', $statement->error);
		return false;
	}

	public function deleteCategory() {
		$query = "DELETE FROM $this->connection_schema.$this->table WHERE id = ?;";

		$this->id = htmlspecialchars(strip_tags($this->id));

		$statement = $this->connection->prepare($query);
		$statement->bindParam(1, $this->id);

		if($statement->execute()) {
			return true;
		}

		printf('Error: ', $statement->error);
		return false;
	}
}

?>
