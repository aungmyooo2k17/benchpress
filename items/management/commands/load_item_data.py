from django.core.management import BaseCommand
from items.models import Item
from csv import DictReader


ALREDY_LOADED_ERROR_MESSAGE = """
If you need to reload the pet data from the CSV file,
first delete the db.sqlite3 file to destroy the database.
Then, run `python manage.py migrate` for a new empty
database with tables"""


class CSV:
    def import_data(self, file):
        with open(file, 'r') as data:
            reader = DictReader(data)
            for item in reader:
                item = Item(
                    uid=item['UID'],
                    name=item['Name'],
                    price=item['Price']
                )
                item.save()


class Command(BaseCommand):
    # Show this when the user types help
    help = "Loads data from data/items.csv into our Item model"

    def handle(self, *args, **options):
        if Item.objects.exists():
            print('Item data already loaded... exiting.')
            print(ALREDY_LOADED_ERROR_MESSAGE)
            return
        print("Creating inventory data")
        csv_reader = CSV()
        csv_reader.import_data('data/items.csv')
