import sqlite3
import unittest
from os import path
from gym.db.db import Connection, Manager, database


class ConnectionTest(unittest.TestCase):

    def getDatabaseLocation(self):
        return path.abspath('./data/database.db')

    def testConnectionCanBeMade(self):
        connection = Connection(sqlite3)
        filepath = self.getDatabaseLocation()
        connected = connection.connect(filepath)

        self.assertTrue(connected)
        connection.close()

    def testGetConnection(self):
        connection = Connection(sqlite3)
        filepath = self.getDatabaseLocation()
        connection.connect(filepath)

        self.assertIsInstance(connection.connection(), sqlite3.Connection)
        connection.close()


class ManagerTest(unittest.TestCase):

    def getDatabaseLocation(self):
        return path.abspath('data/database.db')

    def testMakeConnection(self):
        filepath = self.getDatabaseLocation()
        connection = Connection(sqlite3)
        db = Manager(connection)
        db.make(filepath)
        self.assertIsInstance(db.getConnection(), Connection)

    def testGetData(self):
        db = database('data/database.db')

        results = db.execute('SELECT * FROM users').fetchfirst()

        self.assertEqual(type(results), tuple)
