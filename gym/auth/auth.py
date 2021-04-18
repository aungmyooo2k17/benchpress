from gym.exceptions.auth import AuthenticationException, UserNotFoundException
from gym.models.user import User
from gym.auth.hash import Hash
from decouple import config


class Auth:
    _user = None
    _authenticated = False

    def __init__(self, db, hash=None):
        self.db = db
        self.hash = hash if hash is not None else self.createHasher()

    def createHasher(self):
        return Hash(config('APP_KEY').encode('utf-8'))

    def getUser(self, email):
        user = User(self.db)
        user = user.where('email', email).first()

        if user is None:
            return None

        return user

    def authenticate(self, credentials):
        user = self.getUser(credentials['email'])

        if user is None:
            raise UserNotFoundException('No user was found for that email')

        if not self.hash.check(credentials['password'], user.password.encode('utf-8')):
            raise AuthenticationException('Password does not match')

        self._user = user

        return True

    def login(self, credentials):
        try:
            self._authenticated = self.authenticate(credentials)
        except AuthenticationException:
            return False

        return self._authenticated

    def check(self):
        return self._authenticated
