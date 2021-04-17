from os import path
from abc import ABC
from gym.db.db import Manager
from decouple import config


class Model(ABC):
    _db = None

    def __init__(self, db=None):
        if db is None:
            db = Manager()

        self.initializeDatabase(db)

    def initializeDatabase(self, db):
        db.connect(self.getDatabaseLocation())

        self._db = db

    def getDatabaseLocation(self):
        return path.abspath(config('DB_DATABASE'))
