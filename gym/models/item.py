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

    def setAttributes(self, attributes=()):
        self._attributes = {
            'id': attributes[0],
            'name': attributes[1],
            'price': attributes[2],
        }

    def assertIs(self, id):
        if self.id != id:
            return self.name == id

        return True

    def find(self, id):
        return self.table().where('id', id).first()


class Package(Item):
    pass


class Supplement(Item):
    pass
