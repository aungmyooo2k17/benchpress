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

    def assertIs(self, id):
        if self.id != id:
            return self.name == id

        return True


class Package(Item):
    pass


class Supplement(Item):
    pass
