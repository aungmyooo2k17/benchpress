from gym.models import Model


class User(Model):
    _attributes = {}

    def __init__(self, attributes, db=None):
        super().__init__(db)
        self._attributes = attributes

    @property
    def name(self):
        return self._attrbutes.get('name')

    @property
    def email(self):
        return self._attrbutes.get('email')

    @property
    def password(self):
        return self._attrbutes.get('password')

    def get(self, attribute):
        return self._attribute.get(attribute)
