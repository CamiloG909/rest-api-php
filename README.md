# Rest API with PHP and PostgreSQL

Deploy✨ ...

## Routes categories

- GET
	> /api/categories
	
	> /api/categories?id=:

- POST
	> /api/categories
- PUT
	> /api/categories
  (Body with ID)
- DELETE
	> /api/categories?id=:
	
	## Example body

```json
{
  "id": "Use for update",
	"name": "Technology"
}
```

## Routes products

- GET
	> /api/products
	
	> /api/products?id=:

- POST
	> /api/products
- PUT
	> /api/products
  (Body with ID)
- DELETE
	> /api/products?id=:
	
	## Example body

```json
{
  "id": "Use for update",
	"title": "Mouse gamer",
	"description": "Some text",
	"id_category": 98
}
```
