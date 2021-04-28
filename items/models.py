from django.db import models

# Create your models here.


class Item(models.Model):
    uid = models.CharField(max_length=100)
    name = models.CharField(max_length=100)
    description = models.TextField()
    price = models.DecimalField(max_digits=100, decimal_places=2)

    def valid_item(self, uid):
        try:
            self.objects.get(uid=uid)
        except self.DoesNotExist as exc:
            return False
        except models.MultipleObjectsReturned as exc:
            return True
        return True


class Package(Item):
    pass


class Supplement(Item):
    pass
