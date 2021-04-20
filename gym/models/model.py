from os import path
from abc import ABC, abstractmethod
from gym.db.db import database
from decouple import config
from pprint import pprint
import inflect


class Model(ABC):
    _db = None
    statement = ''
    _attributes = {}

    def __init__(self, attributes={}, db=None):
        if db is None:
            db = database(config('DB_DATABASE'))

        self._db = db
        self._attributes = attributes

    def getDatabaseLocation(self):
        return path.abspath(config('DB_DATABASE'))

    def table(self, name=None):
        if name is None:
            name = self.getTable()

        self.statement = f'SELECT * FROM {name}'

        return self

    def all(self):
        items = {}

        results = self.table()._db.execute(self.statement).fetchall()

        for item in results:
            item = self.reproduce(item)
            items[item.id] = item

        return items

    @classmethod
    def reproduce(cls, attributes=()):
        instance = cls()
        instance.setAttributes(attributes)

        return instance

    def where(self, column, value):
        self.table()

        self.statement = self.statement + ' ' + f"WHERE {column}='{value}'"

        return self

    def first(self):
        self.setAttributes(self._db.execute(self.statement).fetchfirst())

        return self

    @abstractmethod
    def setAttributes(self, attributes=()):
        pass

    def getAttribute(self, attribute):
        return self._attribute.get(attribute)

    def getTable(self):
        inflector = inflect.engine()

        return inflector.plural(type(self).__name__.lower())
