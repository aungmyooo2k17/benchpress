from django.contrib import admin
from invoice.models import Invoice

# Register your models here.


@admin.register(Invoice)
class InvoiceAdmin(admin.ModelAdmin):
    list_display = ['customer', 'due', 'created_at']
