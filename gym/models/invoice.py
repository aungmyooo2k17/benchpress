from gym.models.model import Model


class Invoice(Model):

    def show(self):
        return self.get()

    @property
    def id(self):
        return self._attributes.get('id')

    @property
    def amount(self):
        return self._attributes['price']

    def setAttributes(self, attributes=()):
        pass
