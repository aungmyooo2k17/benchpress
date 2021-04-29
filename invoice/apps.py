from os import urandom
from django.apps import AppConfig
from django.core.serializers import serialize


class InvoiceConfig(AppConfig):
    default_auto_field = 'django.db.models.BigAutoField'
    name = 'invoice'


class Generator:
    details = {}

    def __init__(bill):
        self.generate(bill.details())

    def generate(details):
        self.details = details
        return Invoice(
            uid=urandom(60)
            customer=self.details.get('customer'),
            total=self.details.get('total'),
            discount=self.details.get('discount'),
            due=self.details.get('due'),
            purchases=serialize('json', self.details.get('purchases'))
        )
