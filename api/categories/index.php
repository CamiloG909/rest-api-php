<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require '../../functions.php';

include_once '../../Database.php';
include_once '../../models/Category.php';

$db = new Database();
$db = $db->connect(get_env());

$category = new Category($db);

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET') {
	if(count($_GET) > 0 && !empty($_GET['id'])) {
		// GET CATEGORY
		$category->__set('id', $_GET['id']);

		if(count($category->getCategory()) > 0) {
			$response = [
				'id' => $category->__get('id'),
				'name' => $category->__get('name'),
				'creation_date' => $category->__get('creation_date')
			];

			sendResponse($response);
		} else {
			sendResponse([], 404, 'Category not found');
		}
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

			sendResponse($clean_categories);
		} else {
			sendResponse();
		}
	}
}

// CREATE CATEGORY
if($method == 'POST') {
	$data = json_decode(file_get_contents("php://input"));

	if(isset($data->name) && !empty($data->name)) {
		$category->__set('name', $data->name);

		if($category->addCategory()) {
			sendResponse();
		} else {
			sendResponse([], 500);
		}
	} else {
		sendResponse([], 400, 'Please type category name');
	}
}

// UPDATE CATEGORY
if($method == 'PUT') {
	$data = json_decode(file_get_contents("php://input"));

	if(isset($data->id) && isset($data->name) && !empty($data->id) && !empty($data->name)) {
		$category->__set('id', $data->id);
		$category->__set('name', $data->name);

		if($category->updateCategory()) {
			sendResponse();
		} else {
			sendResponse([], 500);
		}
	} else {
		sendResponse([], 400, 'Please send a valid category');
	}
}

// DELETE CATEGORY
if($method == 'DELETE') {
	if(count($_GET) > 0 && !empty($_GET['id'])) {
		$category->__set('id', $_GET['id']);

		if($category->deleteCategory()) {
			sendResponse();
		} else {
			sendResponse([], 500);
		}
	} else {
		sendResponse([], 400, 'Please type category id');
	}
}

?>
