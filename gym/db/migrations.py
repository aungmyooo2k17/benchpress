create_users_table = """CREATE TABLE IF NOT EXISTS users (
	id integer PRIMARY KEY,
	name text NOT NULL,
	email text NOT NULL,
	password text NOT NULL
);"""

create_items_table = """CREATE TABLE IF NOT EXISTS items (
	id integer PRIMARY KEY,
	uid text NOT NULL,
	name text NOT NULL,
	price double NOT NULL
);"""
