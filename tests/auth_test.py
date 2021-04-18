from pprint import pprint
import unittest
from gym.auth.auth import Auth
from gym.db.db import database


class AuthTest(unittest.TestCase):

    def testGetUser(self):
        db = database('data/database.db')
        auth = Auth(db)

        self.assertIsNone(auth.getUser('test@example.com'))
