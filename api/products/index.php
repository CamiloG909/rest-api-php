<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require '../../functions.php';

include_once '../../Database.php';
include_once '../../models/Product.php';

$db = new Database();
$db = $db->connect(get_env());

$product = new Product($db);

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET') {
	if(count($_GET) > 0 && !empty($_GET['id'])) {
		// GET PRODUCT
		$product->__set('id', $_GET['id']);

		if(count($product->getProduct()) > 0) {
			$response = [
				'id' => $product->__get('id'),
				'title' => $product->__get('title'),
				'description' => $product->__get('description'),
				'creation_date' => $product->__get('creation_date'),
				'category' => $product->__get('category')
			];

			sendResponse($response);
		} else {
			sendResponse([], 404, 'Product not found');
		}
	} else {
		// GET ALL PRODUCTS
		$products = $product->getProducts();

		$amount_products = $products->rowCount();

		if($amount_products > 0) {
			$clean_products = [];

			foreach($products as $product) {
				array_push($clean_products, [
					'id' => $product['id'],
					'title' => $product['title'],
					'description' => $product['description'],
					'creation_date' => $product['creation_date'],
					'category' => $product['category']
				]);
			}

			sendResponse($clean_products);
		} else {
			sendResponse();
		}
	}
}

// CREATE PRODUCT
if($method == 'POST') {
	$data = json_decode(file_get_contents("php://input"));

	if((isset($data->title) && !empty($data->title)) && (isset($data->description) && !empty($data->description)) && (isset($data->id_category) && !empty($data->id_category))) {
		$product->__set('title', $data->title);
		$product->__set('description', $data->description);
		$product->__set('id_category', $data->id_category);

		if($product->addProduct()) {
			sendResponse();
		} else {
			sendResponse([], 500);
		}
	} else {
		sendResponse([], 400, 'Please send a valid product');
	}
}

// UPDATE PRODUCT
if($method == 'PUT') {
	$data = json_decode(file_get_contents("php://input"));

	if((isset($data->id) && !empty($data->id)) && (isset($data->title) && !empty($data->title)) && (isset($data->description) && !empty($data->description)) && (isset($data->id_category) && !empty($data->id_category))) {
		$product->__set('id', $data->id);
		$product->__set('title', $data->title);
		$product->__set('description', $data->description);
		$product->__set('id_category', $data->id_category);

		if($product->updateProduct()) {
			sendResponse();
		} else {
			sendResponse([], 500);
		}
	} else {
		sendResponse([], 400, 'Please send a valid product');
	}
}

// DELETE PRODUCT
if($method == 'DELETE') {
	if(count($_GET) > 0 && !empty($_GET['id'])) {
		$product->__set('id', $_GET['id']);

		if($product->deleteProduct()) {
			sendResponse();
		} else {
			sendResponse([], 500);
		}
	} else {
		sendResponse([], 400, 'Please type product id');
	}
}

?>
