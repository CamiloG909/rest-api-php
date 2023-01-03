<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require '../../config.php';

include_once '../../Database.php';
include_once '../../models/Category.php';

$db = new Database();
$db = $db->connect(get_env());

$category = new Category($db);

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET') {
	if(count($_GET) > 0 && !empty($_GET['id'])) {
		// GET CATEGORY
		echo $_GET['id'];
	} else {
		// GET ALL CATEGORIES
		$categories = $category->getCategories();

		$amount_categories = $categories->rowCount();

		if($amount_categories > 0) {
			$clean_categories = [];

			foreach($categories as $category) {
				array_push($clean_categories, [
					'id' => $category['id'],
					'name' => $category['name'],
					'creation_date' => $category['creation_date']
				]);
			}

			echo json_encode(['data' => $clean_categories]);
		} else {
			echo json_encode(['data' => []]);
		}
	}
}


?>
