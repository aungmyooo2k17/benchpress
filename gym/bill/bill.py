class Bill:
    total = 0
    discount = 0
    due = 0
    discountThreshold = 5000
    discountPercentage = 0.05
    _purchases = {}

    def __init__(self, purchases={}):
        self._purchases = purchases

    def calculate(self):
        for itemId, item in self._purchases.items():
            self.total += item['item'].price * item['units']

        if self.hasDiscount():
            self.discount = self.total * self.discountPercentage

        self.due = self.total - self.discount

    def hasDiscount(self):
        return self.total >= self.discountThreshold

    def details(self):
        details = {
            'Total': self.total,
            'Discount': self.discount,
            'Due': self.due,
        }

        details.update(self._purchases)

        return details

    def setDiscountThreshold(self, amount):
        self.discountThreshold = amount

    def setDiscountPercentage(self, amount):
        self.discountPercentage = amount
