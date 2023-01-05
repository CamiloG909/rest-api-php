<?php

class Product {
	private $table = 'product';
	private $connection;
	private $connection_schema;

	private $id;
	private $title;
	private $description;
	private $creation_date;
	private $id_category;
	private $category;

	public function __construct($db) {
		$this->connection = $db['connection'];
		$this->connection_schema = $db['schema'];
	}

	public function __set($prop, $value) {
		if(property_exists($this, $prop)) {
			$this->$prop = $value;
		} else {
			die();
		}
	}

	public function __get($prop) {
		if(property_exists($this, $prop)) {
			return $this->$prop;
		} else {
			die();
		}
	}

	public function getProducts() {
		$query = "SELECT prod.*, cate.name as category FROM $this->connection_schema.$this->table prod LEFT JOIN $this->connection_schema.category cate ON cate.id = prod.id_category ORDER BY prod.creation_date DESC;";

		$statement = $this->connection->prepare($query);
		$statement->execute();
		return $statement;
	}

	public function getProduct() {
		$query = "SELECT prod.*, cate.name as c_name FROM $this->connection_schema.$this->table prod LEFT JOIN $this->connection_schema.category cate ON cate.id = prod.id_category WHERE prod.id = ? LIMIT 1;";

		$statement = $this->connection->prepare($query);
		$statement->bindParam(1, $this->id);
		$statement->execute();

		$product = $statement->fetchAll(PDO::FETCH_ASSOC);

		if(count($product) == 1) {
			$this->id = $product[0]['id'];
			$this->title = $product[0]['title'];
			$this->description = $product[0]['description'];
			$this->creation_date = $product[0]['creation_date'];
			$this->id_category = $product[0]['id_category'];
			$this->category = $product[0]['c_name'];
			return [[
				'id' => $product[0]['id'],
				'title' => $product[0]['title'],
				'description' => $product[0]['description'],
				'creation_date' => $product[0]['creation_date'],
				'category' => $product[0]['c_name']
			]];
		} else {
			return [];
		}
	}

	public function addProduct() {
		$query = "INSERT INTO $this->connection_schema.$this->table (title, description, id_category) VALUES (?, ?, ?);";

		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->description = htmlspecialchars(strip_tags($this->description));
		$this->id_category = htmlspecialchars(strip_tags($this->id_category));

		$statement = $this->connection->prepare($query);
		$statement->bindParam(1, $this->title);
		$statement->bindParam(2, $this->description);
		$statement->bindParam(3, $this->id_category);

		if($statement->execute()) {
			return true;
		}

		printf('Error: ', $statement->error);
		return false;
	}

	public function updateProduct() {
		$query = "UPDATE $this->connection_schema.$this->table SET title = ?, description = ?, id_category = ? WHERE id = ?;";

		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->description = htmlspecialchars(strip_tags($this->description));
		$this->id_category = htmlspecialchars(strip_tags($this->id_category));

		$statement = $this->connection->prepare($query);
		$statement->bindParam(1, $this->title);
		$statement->bindParam(2, $this->description);
		$statement->bindParam(3, $this->id_category);
		$statement->bindParam(4, $this->id);

		if($statement->execute()) {
			return true;
		}

		printf('Error: ', $statement->error);
		return false;
	}

	public function deleteProduct() {
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
