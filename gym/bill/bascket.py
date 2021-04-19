class Bascket:
    _bascket = {}

    def __init__(self, bascket={}):
        self._bascket = bascket

    def add(self, item, units):
        self._bascket[item.id] = {
            'item': item,
            'units': units
        }

    def remove(self, id):
        del self._bascket[id]

    def getItem(self, id):
        return self._bascket[id]

    def get(self):
        return self._bascket
