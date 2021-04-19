from gym.exceptions.auth import AuthenticationException, UserNotFoundException
from gym.models.user import User
from gym.auth.hash import Hash
from decouple import config


class Auth:
    _db = None
    _user = None
    _authenticated = False

    def __init__(self, db, hash=None):
        self._db = db
        self.hash = hash if hash is not None else self.createHasher()

    def createHasher(self):
        return Hash(config('APP_KEY'))

    def getUser(self, email):
        user = User(db=self._db)

        return user.where('email', email).first()

    def authenticate(self, credentials):
        user = self.getUser(credentials['email'])

        if user is None:
            raise UserNotFoundException('No user was found for that email')

        if not self.hash.check(user.password, credentials['password']):
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
