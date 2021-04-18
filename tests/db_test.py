import sqlite3
from os import path
from pprint import pprint
import sys
import unittest
from gym.db.db import Connection, Manager


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

    def testGetCursor(self):
        connection = Connection(sqlite3)
        filepath = self.getDatabaseLocation()
        connection.connect(filepath)

        self.assertIsInstance(connection.cursor(), sqlite3.Cursor)
        connection.close()


class ManagerTest(unittest.TestCase):

    def getDatabaseLocation(self):
        return path.abspath('./data/database.db')

    def testMakeConnection(self):
        filepath = self.getDatabaseLocation()
        connection = Connection(sqlite3)
        db = Manager(connection)
        db.make(filepath)
        self.assertIsInstance(db.getConnection(), Connection)
