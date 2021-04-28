from django.apps import AppConfig
from csv import DictReader


class ItemsConfig(AppConfig):
    default_auto_field = 'django.db.models.BigAutoField'
    name = 'items'
