from gym.models.model import Model


class Item(Model):

    @property
    def id(self):
        return self._attributes.get('id')

    @property
    def name(self):
        return self._attributes.get('name')

    @property
    def price(self):
        return self._attributes.get('price')

    @property
    def units(self):
        return self._attributes.get('units')

    def increment(self):
        ++self._attributes['units']

    def decrement(self):
        --self._attributes['units']

    def setAttributes(self, attributes=()):
        pass

    def assertIs(self, id):
        if self.id != id:
            return self.name == id

        return True

    def find(self, id):
        return self.table(self.table).where('id', id).first()


class Package(Item):
    table = 'packages'


class Supplement(Item):
    table = 'supplements'
