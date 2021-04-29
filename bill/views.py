from django.shortcuts import render
from bill.apps import Bill, Bascket
from invoice.apps import Generator as InvoiceGenerator
from django.http import JsonResponse
from django.core.serializers import serialize

# Create your views here.

class BillController:
    purchases = None

    def bascket(self, request):
        self.purchases = Bascket(request['items'])

    def checkout(self, request, customer):
        bill = Bill(self.purchases)
        bill.set_customer(customer)
        bill.calculate()
        invoice = self.generate_invoice(bill)
        return JsonResponse(serialize('json', invoice), safe=False)

    def generate_invoice(self, bill):
        invoice = InvoiceGenerator(bill)
        return invoice


