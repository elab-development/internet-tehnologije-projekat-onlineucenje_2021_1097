from django.contrib import admin
from django.urls import path,include
from .import views,user_login
from django.conf import settings
from django.conf.urls.static import static
from django.contrib.auth import views as auth_views
from django.urls import path


urlpatterns = [
    path('admin/', admin.site.urls),

    path('base', views.BASE, name="base"),
    path('404', views.PAGE_NOT_FOUND, name="404"),
    path('', views.HOME, name="home"),
    path('courses', views.SINGLE_COURSE, name="single_course"),
    path('course/filter-data',views.filter_data,name="filter-data"),
    path('course/<slug:slug>',views.COURSE_DETAILS,name='course_details'),


    path('search',views.SEARCH_COURSE,name="search_course"),
    path('contact', views.CONTACT, name="contact"),
    path('about', views.ABOUT, name="about"),
    path('accounts/register', user_login.REGISTER, name='register'),

    path('accounts/', include('django.contrib.auth.urls')),
    path('doLogin', user_login.DO_LOGIN, name='dologin'),

    path('accounts/logout/', auth_views.LogoutView.as_view(), name='logout'),
    path('accounts/logout/', user_login.DO_LOGOUT, name='logout'),
    path('accounts/profile',user_login.PROFILE,name='profile'),
    path('accounts/profile/update',user_login.PROFILE_UPDATE,name='profile_update'),
    path('checkout/<slug:slug>',views.CHECKOUT, name='checkout'),
    path('my-course',views.my_course_api,name='my_course'),
    path('export-courses/', views.export_courses_csv, name='export_courses_csv'),


    path('create_course', views.create_course, name='create_course'),


]+static(settings.MEDIA_URL, document_root = settings.MEDIA_ROOT)