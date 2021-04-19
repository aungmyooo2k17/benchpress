import os
from pprint import pprint
from decouple import config
import sys
import sqlite3


def runMigrations():
    import gym.db.migrations as migrations
    from gym.db.db import database

    db = database(config('DB_DATABASE'))

    for name, migration in vars(migrations).items():
        if not name.startswith('__'):
            db.execute(migration)

    db.close()


def dropTables():
    database = config('DB_DATABASE')

    if os.path.exists(database):
        os.remove(os.path.abspath(database))

    try:
        dataFile = open(database, "x")
    except print(0):
        pass

    dataFile.close()


if __name__ == '__main__':
    sys.path.append(os.path.abspath(os.path.join('..', 'gym')))
    dropTables()
    runMigrations()
