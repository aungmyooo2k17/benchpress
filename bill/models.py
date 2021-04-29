from django.db import models
from items.models import Item

# Create your models here.


class Bascket(models.Model):
    item = models.CharField(max_length=100)
    units = models.BigIntegerField(default=0, blank=True)

    @classmethod
    def add(cls, item, units):
        cls.objects.update_or_create(item=item, units=units)

    @classmethod
    def remove(cls, item):
        cls.objects.get(item=item).delete()

    @classmethod
    def details(cls):
        return cls.objects.all()

    def get_item(self, id):
        return Item.objects.get(uid=id)

    def get(self):
        items = {}
        for purchase in self.details():
            items[purchase.item] = {
                'item': self.get_item(purchase.item),
                'units': purchase.units
            }
        return items
