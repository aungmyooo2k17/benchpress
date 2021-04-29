"""gym URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/3.2/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""

from django.contrib import admin
from django.urls import path
from gym.views import home
from bill import views as bill_views
from items import views as item_views
from invoice import views as invoice_views

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', home),
    path('items', item_views.index, name='items_index'),
    path('items/<str:uid>/', item_views.show, name='items_show'),
    path('bascket', bill_views.store, name='bill_bascket_store'),
    path('bascket', bill_views.destroy, name='bill_bascket_destroy'),
    path('checkout/<str:customer>/', bill_views.show, name='bill_checkout'),
    path('invoices', invoice_views.index, name='invoices_index'),
    path('invoices/<int:uid>/', invoice_views.show, name='invoices_show'),
]
