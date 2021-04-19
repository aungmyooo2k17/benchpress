from pprint import pprint
import unittest
from gym.models.item import Package, Supplement


class PackageTest(unittest.TestCase):

    def testCanBeInstatiated(self):
        package = Package({
            'id': 'PKGD001',
            'name': 'Test Package',
            'price': 3000.00,
        })

        self.assertEqual('PKGD001', package.id)
        self.assertEqual('Test Package', package.name)
        self.assertEqual(3000.00, package.price)

    def testCanAssertSelf(self):
        package = Package({
            'id': 'PKGD001',
            'name': 'Test Package',
            'price': 3000.00,
        })

        self.assertTrue(package.assertIs(package.id))

    def testCanBeFoundInDatabase(self):
        package = Package()
        package = package.find(1)

        self.assertEqual('DAY WORKOUT', package.name)


class SupplementTest(unittest.TestCase):

    def testCanBeInstatiated(self):
        supplement = Supplement({
            'id': 'ITM001',
            'name': 'AMOLYTES',
            'price': 1500.00
        })

        self.assertEqual('ITM001', supplement.id)
        self.assertEqual('AMOLYTES', supplement.name)
        self.assertEqual(1500.00, supplement.price)

    def testCanAssertSelf(self):
        supplement = Supplement({
            'id': 'ITM001',
            'name': 'AMOLYTES',
            'price': 1500.00
        })

        self.assertTrue(supplement.assertIs(supplement.id))

    def testCanBeFoundInDatabase(self):
        supplement = Supplement()
        supplement = supplement.find(1)

        self.assertEqual('BEAST SUPER SAUNA', supplement.name)
