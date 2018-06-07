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