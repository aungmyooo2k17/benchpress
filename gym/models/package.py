from gym.models import Model


class Item(Model):
    _id = ''
    _name = ''
    _price = 0

    def __init__(self, id, name, price, db=None):
        super().__init__(db)
        self._id = id
        self._name = name
        self._price = price

    @property
    def id(self):
        return self._id

    @property
    def name(self):
        return self._name

    @property
    def price(self):
        return self._price

    def assertIs(self, id):
        if self._id != id:
            return self._name == id

        return True


class Package(Item):
    pass


class Supplement(Item):
    pass
