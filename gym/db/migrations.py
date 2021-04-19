create_users_table = """CREATE TABLE IF NOT EXISTS users (
	id integer PRIMARY KEY,
	name text NOT NULL,
	email text NOT NULL,
	password text NOT NULL
);"""

create_packages_table = """CREATE TABLE IF NOT EXISTS packages (
	id integer PRIMARY KEY,
	name text NOT NULL,
	price double NOT NULL
);"""

create_supplements_table = """CREATE TABLE IF NOT EXISTS supplements (
	id integer PRIMARY KEY,
	name text NOT NULL,
	price double NOT NULL
);"""
