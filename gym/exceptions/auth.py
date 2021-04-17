class AuthenticationException(Exception):
    pass


class UserNotFoundException(AuthenticationException):
    pass
