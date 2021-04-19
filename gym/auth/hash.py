import hashlib
import binascii


class Hash:
    _rounds = 100000
    _length = 128

    def __init__(self, salt):
        self._salt = salt.encode('ascii')

    def make(self, password):
        return (self._salt + self.hash(password)).decode('ascii')

    def check(self, hashedValue, value):
        salt = self.extractSaltValue(hashedValue)
        hashedValue = self.extractKey(hashedValue)

        return self.hash(value, salt).decode('ascii') == hashedValue

    def extractSaltValue(self, hashed):
        return hashed[:64]

    def extractKey(self, hashed):
        return hashed[64:]

    def hash(self, value, salt=None):
        if salt is None:
            salt = self._salt

        if type(salt) is not bytes:
            salt = salt.encode('utf-8')

        return binascii.hexlify(hashlib.pbkdf2_hmac(
            'sha512', value.encode('utf-8'), salt, self._rounds
        ))
