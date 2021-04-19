from pprint import pprint
from gym.models.item import Package


def run():
    package = Package()
    packages = package.all()

    for id, item in packages.items():
        pprint(item.name)


if __name__ == '__main__':
    run()
