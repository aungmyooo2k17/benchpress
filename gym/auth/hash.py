import hashlib
import binascii
import os


class Hash:
    _rounds = 100000
    _length = 128

    def __init__(self, salt):
        self._salt = salt.encode('ascii')

    def make(self, password):
        hashed = binascii.hexlify(hashlib.pbkdf2_hmac(
            'sha512',
            password.encode('utf-8'),
            self._salt,
            self._rounds
        ))

        return (self._salt + hashed).decode('ascii')

    def check(self, hashedValue, value):
        salt = self.extractSaltValue(hashedValue)
        hashedValue = self.extractKeyalue(hashedValue)

        hashed = binascii.hexlify(hashlib.pbkdf2_hmac(
            'sha512',
            value.encode('utf-8'),
            salt.encode('ascii'),
            self._rounds
        )).decode('ascii')

        return hashed == hashedValue

    def extractSaltValue(self, hashed):
        return hashed[:64]

    def extractKeyalue(self, hashed):
        return hashed[64:]
