import unittest
from gym.bill.bascket import Bascket
from gym.models.item import Package


class BascketTest(unittest.TestCase):

    def testIstantiation(self):
        bascket = Bascket({})

        self.assertIsInstance(bascket, Bascket)

    def testAddToBascket(self):
        bascket = Bascket({})
        package = Package({
            'id': 1,
            'name': 'Sample Package',
            'price': 1500,
        })

        bascket.add(package, 2)

        self.assertTrue(bascket.get())

    def testRemoveFromBascket(self):
        bascket = Bascket({})
        package = Package({
            'id': 1,
            'name': 'Sample Package',
            'price': 1500,
        })

        bascket.add(package, 2)
        bascket.remove(package.id)

        self.assertFalse(bascket.get())

    def testGetFromBascket(self):
        bascket = Bascket({})
        package = Package({
            'id': 1,
            'name': 'Sample Package',
            'price': 1500,
        })

        bascket.add(package, 2)

        result = bascket.getItem(package.id)

        self.assertTrue(package.assertIs(result['item'].id))
