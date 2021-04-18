from os import path
from abc import ABC
from gym.db.db import database
from decouple import config


class Model(ABC):
    _db = None
    statement = ''
    _attributes = {}

    def __init__(self, attributes, db=None):
        if db is None:
            db = database(config('DB_DATABASE'))

        self._db = db
        self._attributes = attributes

    def getDatabaseLocation(self):
        return path.abspath(config('DB_DATABASE'))

    def table(self, name):
        self.statement = f'SELECT * FROM {name}'

        return self

    def where(self, column, value):
        self.statement + ' ' + f'WHERE {column}={value}'

        return self

    def first(self):
        return (
            self._db
            .executeStatement(self.statement)
            .getConnection()
            .fetchfirst()
        )

    def getAttribute(self, attribute):
        return self._attribute.get(attribute)
