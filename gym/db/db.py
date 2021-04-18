import os
import sqlite3
import itertools
from sqlite3 import Error


class Connection:
    _driver = None
    _connection = None

    def __init__(self, driver):
        self._driver = driver

    def connect(self, database):
        try:
            if self._driver is None:
                self._driver = sqlite3

            self._connection = self._driver.connect(
                database, check_same_thread=False
            )
        except Error as e:
            print(e)

            return False

        return True

    def connection(self):
        if self._connection is None:
            self.connect()

        return self._connection

    def close(self):
        self._connection.close()


class Manager:
    _cursor = None
    _connection = None
    _database = 'database.db'

    def __init__(self, connection):
        self._connection = connection

    def make(self, database=None):
        if database is None:
            database = self._database

        if self._connection.connect(database):
            self.setCursor(self._connection.connection())

    def setCursor(self, connection):
        self._cursor = connection.cursor()

    def getConnection(self):
        return self._connection

    def execute(self, query):
        self._cursor.execute(query)

        return self

    def fetchall(self):
        return self._cursor.fetchall()

    def fetchfirst(self):
        return self._cursor.fetchone()

    def commit(self):
        self._connection.commit()

        return self

    def close(self):
        self._connection.close()


def database(database, connection=None):
    if connection is None:
        connection = Connection(sqlite3)

    manager = Manager(connection)
    manager.make(os.path.abspath(database))

    return manager
