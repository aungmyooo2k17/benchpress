import json
from pprint import pprint
from items.models import Item
from django.test import TestCase

# Create your tests here.


class BillTest(TestCase):
    def setUp(self):
        Item.objects.create(
            uid='PKGDT001', name='DAY WORKOUT', price=1500, type='M'
        )
        Item.objects.create(
            uid='PKGDT002', name='EXECUTIVE MEM', price=3000, type='M'
        )

    def test_can_create_bascket(self):
        response1 = self.client.post('/bascket', {
            'item': 'PKGDT001',
            'units': 2
        })
        response2 = self.client.post('/bascket', {
            'item': 'PKGDT002',
            'units': 4
        })

        self.assertEquals(
            {'purchases': ['PKGDT001']},
            json.loads(response1.content.decode('utf-8'))
        )
        self.assertEquals(
            {'purchases': ['PKGDT001', 'PKGDT002']},
            json.loads(response2.content.decode('utf-8'))
        )

    def test_can_calculate_bill(self):
        # self.client.post('/bascket', {
        #     'item': 'PKGDT001',
        #     'units': 2
        # })
        # self.client.post('/bascket', {
        #     'item': 'PKGDT002',
        #     'units': 4
        # })

        response = self.client.get('/checkout/Thavarshan')
        pprint(response)
        # pprint(json.loads(response.content.decode('utf-8')))
