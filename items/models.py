from django.db import models

# Create your models here.


class Item(models.Model):
    TYPES = [('M', 'Membership'), ('S', 'Supplement')]
    uid = models.CharField(max_length=100)
    name = models.CharField(max_length=100)
    description = models.TextField()
    price = models.DecimalField(max_digits=100, decimal_places=2)
    type = models.CharField(max_length=100, choices=TYPES, default='M')

    def valid_item(self, uid):
        try:
            self.objects.get(uid=uid)
        except self.DoesNotExist as exc:
            return False
        except models.MultipleObjectsReturned as exc:
            return True
        return True

    def filterBy(self, *filter):
        return self.objects.filter(**filter).order_by('name')


class Package(Item):
    def all(self):
        return self.filterBy(type='M').order_by('name')


class Supplement(Item):
    def all(self):
        return self.filterBy(type='S').order_by('name')
