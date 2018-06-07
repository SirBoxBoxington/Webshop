# Stored data

## Users:

### User types
* Guest. Rights:
	* Register (add entry in user table)
* Registered user. Rights:
	* Read product table.
	* Add entry in purchases table.
* Admin. Rights:
	* Read and edit product table.
* Root (database admin). Rights:
	* All.

### Password
Not actual password but sha256-hash is saved.
	
	
# Interface
	
## PHP
Prepared-Statements not useful because registration only happens once in a while.

Functions:
* Connect as guest
* Register
	* Check login info
	* Add new user.

## JS
Prepared-Statements implemented using:
https://github.com/sidorares/node-mysql2/blob/master/documentation/Prepared-Statements.md

All input needs to be checked with regex whitelist!

Functions:
* Get products by name (everyone): Sends all matching products, including ID for editing by admin.
* Add product (admin)
* Edit product (admin)
* Delete product (admin)