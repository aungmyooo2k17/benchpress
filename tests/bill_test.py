import unittest
from gym.bill.bill import Bill
from gym.models.item import Package


class BillTest(unittest.TestCase):

    def testCalculatePurchaseBill(self):
        purchases = {
            'PKGDT001': {
                'item': Package({
                    'name': 'Sample Package',
                    'price': 1500,
                }),
                'units': 2
            }
        }

        bill = Bill(purchases)
        bill.calculate()

        self.assertEqual(3000, bill.total)
        self.assertEqual(3000, bill.due)
        self.assertEqual(0, bill.discount)

    def testCalculatePurchaseBillWithDiscount(self):
        purchases = {
            'PKGDT001': {
                'item': Package({
                    'name': 'Sample Package',
                    'price': 3000,
                }),
                'units': 2
            }
        }

        bill = Bill(purchases)
        bill.calculate()

        self.assertEqual(6000, bill.total)
        self.assertEqual(5700, bill.due)
        self.assertEqual(300, bill.discount)

    def testSetBillDiscountThreshold(self):
        purchases = {
            'PKGDT001': {
                'item': Package({
                    'name': 'Sample Package',
                    'price': 1500,
                }),
                'units': 2
            }
        }

        bill = Bill(purchases)
        bill.setDiscountThreshold(3000)
        bill.calculate()

        self.assertEqual(3000, bill.total)
        self.assertEqual(2850, bill.due)
        self.assertEqual(150, bill.discount)

    def testSetBillDiscountPercentage(self):
        purchases = {
            'PKGDT001': {
                'item': Package({
                    'name': 'Sample Package',
                    'price': 3000,
                }),
                'units': 2
            }
        }

        bill = Bill(purchases)
        bill.setDiscountPercentage(0.5)
        bill.calculate()

        self.assertEqual(6000, bill.total)
        self.assertEqual(3000, bill.due)
        self.assertEqual(3000, bill.discount)

    def testGetBillingDetails(self):
        package = Package({
            'name': 'Sample Package',
            'price': 1500,
        })
        purchases = {
            'PKGDT001': {
                'item': Package({
                    'name': 'Sample Package',
                    'price': 1500,
                }),
                'units': 2
            }
        }

        bill = Bill(purchases)
        bill.calculate()

        details = bill.details()

        self.assertEqual(3000, details['Total'])
        self.assertEqual(3000, details['Due'])
        self.assertEqual(0, details['Discount'])
        self.assertTrue(package.assertIs(details['PKGDT001']['item'].id))
