from gym.models.model import Model


class User(Model):

    @property
    def name(self):
        return self._attributes.get('name')

    @property
    def email(self):
        return self._attributes.get('email')

    @property
    def password(self):
        return self._attributes.get('password')
