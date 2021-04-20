from gym.bill.bill import Bill
from gym.models.item import Package
from gym.bill.bascket import Bascket
from gym.models.invoice import Invoice


def run():
    packageId = None
    units = 0

    package = Package()
    package = package.find(packageId)

    bascket = Bascket({})
    bascket.add(package, units)

    bill = Bill(bascket.get())
    bill.calculate()

    invoice = Invoice(bill.details())

    invoice.show()


if __name__ == '__main__':
    run()
