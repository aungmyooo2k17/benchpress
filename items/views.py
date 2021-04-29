from items.models import Item
from django.core.serializers import serialize
from django.http import JsonResponse

# Create your views here.


def index(request):
    return JsonResponse(
        serialize('json', Item.objects.all()),
        safe=False
    )


def show(request, uid):
    return JsonResponse(
        serialize('json', [Item.objects.get(uid=uid), ]),
        safe=False
    )
