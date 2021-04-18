import os
import hashlib
from pprint import pprint
from gym.auth.hash import Hash
from decouple import config


def run():
    hash = Hash(config('APP_KEY'))
    pprint(hash.make('password'))


if __name__ == '__main__':
    run()
