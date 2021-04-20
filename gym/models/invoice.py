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

    @property
    def customer(self):
        return self._attributes['customer']

    @property
    def items(self):
        return self._attributes['items']

    def setAttributes(self, attributes=()):
        self._attributes = {
            'id': attributes[0],
            'amount': attributes[1],
            'customer': attributes[2],
            'items': attributes[3],
        }
