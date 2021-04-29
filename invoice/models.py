from django.db import models

# Create your models here.


class Invoice(models.Model):
    uid = models.BigIntegerField()
    customer = models.CharField(max_length=100)
    total = models.DecimalField(max_digits=100, decimal_places=2, default=0)
    discount = models.DecimalField(max_digits=100, decimal_places=2, default=0)
    due = models.DecimalField(max_digits=100, decimal_places=2, default=0)
    created_at = models.DateTimeField(auto_now=True, auto_now_add=True)
    purchases = models.JSONField()

    def has_discount(self):
        return self.discount > 0

