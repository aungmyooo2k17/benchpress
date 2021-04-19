from pprint import pprint
import unittest
from gym.models.user import User


class UserTest(unittest.TestCase):

    def testCanBeInstatiated(self):
        user = User({
            'name': 'Test User',
            'email': 'test@example.com',
            'password': 'password'
        })

        self.assertEqual('Test User', user.name)
        self.assertEqual('test@example.com', user.email)
        self.assertEqual('password', user.password)
