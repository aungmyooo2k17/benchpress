import os
from pprint import pprint
from decouple import config
import sys
import sqlite3


def seedDatabase():
    import gym.db.seeders as seeders
    from gym.db.db import Connection, Manager

    db = Manager(Connection(sqlite3))
    db.make(os.path.abspath(config('DB_DATABASE')))

    for name, seeder in vars(seeders).items():
        if not name.startswith('__'):
            db.executeStatement(seeder)

    db.close()


if __name__ == '__main__':
    sys.path.append(os.path.abspath(os.path.join('..', 'gym')))
    seedDatabase()
