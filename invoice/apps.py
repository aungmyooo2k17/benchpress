from os import urandom
from django.apps import apps
from django.apps import AppConfig
from django.core.serializers import serialize


class InvoiceConfig(AppConfig):
    default_auto_field = 'django.db.models.BigAutoField'
    name = 'invoice'


class Generator:
    details = {}

    def __init__(self, bill):
        self.generate(bill.details())

    def generate(self, details):
        self.details = details
        Invoice = apps.get_model('invoice', 'Invoice')
        information = Invoice.objects.create(
            uid=urandom(60),
            customer=self.details.get('customer'),
            total=self.details.get('total'),
            discount=self.details.get('discount'),
            due=self.details.get('due'),
            purchases=serialize('json', self.details.get('purchases'))
        )
        return information
