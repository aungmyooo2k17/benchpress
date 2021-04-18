import hashlib


class Hash:
    _rounds = 100000
    _length = 128

    def __init__(self, salt):
        self._salt = salt

    def make(self, value):
        return self.key(value)

    def check(self, value, hashedValue):
        [key, salt] = self.parse(hashedValue)

        return self.key(value, salt) == hashedValue

    def parse(self, hashedValue):
        return [hashedValue[32:], hashedValue[:32]]

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
