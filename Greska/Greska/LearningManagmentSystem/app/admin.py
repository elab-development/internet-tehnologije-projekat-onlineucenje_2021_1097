from django.contrib import admin
from .models import *
# Register your models here.

admin.site.register(Categories)
admin.site.register(Author)
admin.site.register(Course)
admin.site.register(Level)
admin.site.register(UserCourse)