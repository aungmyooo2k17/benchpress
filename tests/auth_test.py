from pprint import pprint
import unittest
from gym.auth.auth import Auth
from gym.db.db import database


class AuthTest(unittest.TestCase):

    def testGetUser(self):
        db = database('data/database.db')
        auth = Auth(db)

        user = auth.getUser('test@example.com')

        self.assertEqual('test@example.com', user.email)

    def testAuthenticateUser(self):
        db = database('data/database.db')
        auth = Auth(db)
        self.assertTrue(auth.authenticate({
            'email': 'test@example.com',
            'password': 'password'
        }))
