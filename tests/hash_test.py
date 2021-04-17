import os
import unittest
from gym.auth.hash import Hash


class HashTest(unittest.TestCase):

    def generateSalt(self):
        return os.urandom(32)

    def testHashValue(self):
        salt = self.generateSalt()
        hash = Hash(salt)
        self.assertIsInstance(hash.make('my$ecur3p@$$w0rd'), bytes)

    def testCheckhashValue(self):
        salt = self.generateSalt()
        hash = Hash(salt)
        value = 'my$ecur3p@$$w0rd'
        hashed = hash.make('my$ecur3p@$$w0rd')

        self.assertTrue(hash.check(value, hashed))
