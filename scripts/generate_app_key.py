import os
import hashlib
from pprint import pprint


def generateKey():
    pprint(hashlib.sha256(os.urandom(60)).hexdigest())


if __name__ == '__main__':
    generateKey()
