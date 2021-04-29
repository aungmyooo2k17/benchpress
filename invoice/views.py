from invoice.models import Invoice
from django.http import JsonResponse
from django.core.serializers import serialize

# Create your views here.


def index(request):
    return JsonResponse(
        serialize('json', Invoice.objects.all()),
        safe=False
    )


def show(request, id):
    return JsonResponse(
        serialize('json', [Invoice.objects.get(id=id), ]),
        safe=False
    )
