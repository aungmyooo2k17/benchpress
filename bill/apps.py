from django.apps import AppConfig
from django.apps import apps
from pprint import pprint


class BillConfig(AppConfig):
    default_auto_field = 'django.db.models.BigAutoField'
    name = 'bill'


class Bill:
    total = 0
    discount = 0
    due = 0
    discount_threshold = 5000
    discount_percentage = 0.05
    bascket = None
    customer = None

    def __init__(self, bascket):
        self.bascket = bascket

    def calculate(self):
        for item in self.bascket.get():
            self.total += item['item'].price * item['units']
        if self.has_discount():
            self.discount = self.total * self.discount_percentage
        self.due = self.total - self.discount

    def has_discount(self):
        return self.total >= self.discount_threshold

    def details(self):
        details = {
            'total': self.total,
            'discount': self.discount,
            'due': self.due,
            'customer': self.customer
        }
        details.update({'purchases': self.bascket})
        return details

    def set_discount_threshold(self, amount):
        self.discount_threshold = amount

    def set_discount_percentage(self, amount):
        self.discount_percentage = amount

    def set_customer(self, name):
        self.customer = name
