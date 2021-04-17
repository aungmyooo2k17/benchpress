import hashlib


class Hash:
    _rounds = 100000
    _length = 128

    def __init__(self, salt):
        self._salt = salt

    def make(self, value):
        return self.key(value)

    def check(self, value, hashedValue):
        key = hashedValue[32:]
        salt = hashedValue[:32]

        return self.key(value, salt) == salt + key

    def key(self, value, salt=None):
        if salt is None:
            salt = self._salt

        key = hashlib.pbkdf2_hmac(
            'sha256',
            value.encode('utf-8'),
            salt,
            self._rounds,
            dklen=self._length
        )

        return salt + key
