from pprint import pprint
from bill.apps import Bill
from django.views import View
from bill.models import Bascket
from django.http import JsonResponse
from django.core.serializers import serialize
from invoice.apps import Generator as InvoiceGenerator

# Create your views here.


def createBascket():
    return Bascket()


def store(request):
    createBascket().add(
        request.POST.get('item'),
        int(request.POST.get('units'))
    )
    return JsonResponse({'purchases': list(createBascket().get().keys())})


def destroy(request):
    createBascket().remove(request.POST.get('item'))
    return JsonResponse({'purchases': list(createBascket().get().keys())})


def show(request, customer):
    pprint(customer)
    # bill = Bill(createBascket())
    # bill.set_customer(customer)
    # bill.calculate()
    # invoice = self.generate_invoice(bill)
    # pprint(invoice)
    # return JsonResponse(serialize('json', invoice), safe=False)


def generate_invoice(bill):
    invoice = InvoiceGenerator(bill)
    return invoice
