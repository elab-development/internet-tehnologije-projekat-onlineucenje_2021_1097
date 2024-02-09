from app.models import Categories,Course,Level,UserCourse
from django.http import JsonResponse, HttpResponseRedirect
from django.template.loader import render_to_string
from django.http import JsonResponse
from django.shortcuts import get_object_or_404
import csv
from django.http import HttpResponse
from django.shortcuts import render, redirect
from app.forms import CourseForm
from django.contrib.auth.decorators import login_required

from rest_framework.decorators import api_view
from .serializer import UserCourseSerializer,CourseSerializer

def BASE(request):
    return render(request,'base.html')




@api_view(['GET'])
def HOME(request):
    course = Course.objects.all().order_by('id')
    serializer = CourseSerializer(course, many=True)
    serialized_data = serializer.data
    context = {

        'course': serialized_data
    }
    return render(request,'Main/home.html',context)

@login_required
def SINGLE_COURSE(request):
    category = Categories.get_all_category(Categories)
    level = Level.objects.all()
    course = Course.objects.all()
    FreeCourse_count = Course.objects.filter(price=0).count()
    PaidCourse_count = Course.objects.filter(price__gte=1).count()

    context = {
        'category':category,
        'level':level,
        'course':course,
        'FreeCourse_count':FreeCourse_count,
        'PaidCourse_count':PaidCourse_count

    }
    return render(request,'Main/single_course.html',context)

from django.db.models import Q

def filter_data(request):
    categories = request.GET.getlist('category[]')
    level = request.GET.getlist('level[]')
    price = request.GET.getlist('price[]')

    filters = Q()

    if 'pricefree' in price:
        filters &= Q(price=0)

    if 'pricepaid' in price:
        filters &= Q(price__gte=1)

    if categories:
        filters &= Q(category__id__in=categories)

    if level:
        filters &= Q(level__id__in=level)

    course = Course.objects.filter(filters).order_by('-id')

    t = render_to_string('ajax/course.html', {'course': course})



    return JsonResponse({'data': t})


@login_required
def create_course(request):
    if request.method == 'POST':
        form = CourseForm(request.POST, request.FILES)
        if form.is_valid():
            course = form.save(commit=False)
            course.save()
            return redirect('home')
    else:
        form = CourseForm()

    return render(request, 'course/create_course.html', {'form': form})


def export_courses_csv(request):
    course_data = [
        ['Title', 'Category', 'Author', 'Price'],

    ]
    course = UserCourse.objects.filter(user=request.user)
    for i in course:
        course_data.append([
            i.course.title,
            i.course.category.name,
            i.course.author.name,
            i.course.price,
        ])

    response = HttpResponse(content_type='text/csv')
    response['Content-Disposition'] = 'attachment; filename="course_data.csv"'


    writer = csv.writer(response)
    for row in course_data:
        writer.writerow(row)

    return response








def CONTACT(request):
    category = Categories.get_all_category(Categories)
    context = {
        'category':category
    }

    return render(request,'Main/contact.html',context)

def ABOUT(request):
    category = Categories.get_all_category(Categories)
    context = {
        'category': category
    }

    return render(request,'Main/about.html',context)



@api_view(['GET'])
def SEARCH_COURSE(request):
    query = request.GET['query']
    course = Course.objects.filter(title__icontains = query )
    print(course)

    serializer = CourseSerializer(course, many=True)
    serialized_data = serializer.data

    context = {
        'course': serialized_data
    }
    return render(request,'search/search.html',context)



@login_required
def COURSE_DETAILS(request,slug):
    course = get_object_or_404(Course, slug=slug)
    course_id = Course.objects.get(slug=slug)

    try:
        check_enroll = UserCourse.objects.get(user=request.user, course=course_id)

    except UserCourse.DoesNotExist:
        check_enroll=None

    context = {
        'course':course,
        'check_enroll':check_enroll
    }

    return render(request,'course/course_details.html',context)

def PAGE_NOT_FOUND(request):
    category = Categories.get_all_category(Categories)
    context = {
        'category': category
    }

    return render(request,'error/404.html',context)

def CHECKOUT(request,slug):
    course = get_object_or_404(Course, slug=slug)

    if course.price == 0:
        course = UserCourse(
            user = request.user,
            course = course,
        )
        course.save()
        return redirect('home')
    return render(request,'checkout/checkout.html')




@api_view(['GET'])
def my_course_api(request):
    courses = UserCourse.objects.filter(user=request.user)
    serializer = UserCourseSerializer(courses, many=True)
    serialized_data = serializer.data
    context = {
        'courses': serialized_data
    }
    print(context)
    return render(request, 'course/my-course.html',context)
