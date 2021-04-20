import hashlib
from re import sub
from tempfile import mkstemp
from shutil import move, copymode
from os import path, fdopen, remove, urandom


def generateKey():
    key = hashlib.sha256(urandom(60)).hexdigest()
    envFile = path.abspath('./.env')
    fh, absPath = mkstemp()
    pattern = '(APP_KEY=)([a-zA-Z_0-9]*)'

    with fdopen(fh, 'w') as env:
        with open(envFile) as old_file:
            for line in old_file:
                env.write(sub(pattern, 'APP_KEY=' + key, line))

    copymode(envFile, absPath)
    remove(envFile)
    move(absPath, envFile)


if __name__ == '__main__':
    generateKey()
