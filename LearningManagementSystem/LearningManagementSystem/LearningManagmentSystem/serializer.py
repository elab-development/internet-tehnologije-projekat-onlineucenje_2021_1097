



from rest_framework import serializers
from app.models import UserCourse,Course

class CourseSerializer(serializers.ModelSerializer):
    author_name = serializers.CharField(source='author.name', read_only=True)
    author_profile = serializers.ImageField(source='author.author_profile', read_only=True)
    category_name = serializers.CharField(source='category.name', read_only=True)

    class Meta:
        model = Course
        fields = ('title', 'category', 'category_name', 'author', 'author_name', 'author_profile', 'price', 'discount', 'get_absolute_url', 'featured_image')

class UserCourseSerializer(serializers.ModelSerializer):
    course_det = CourseSerializer(source='course', read_only=True)

    class Meta:
        model = UserCourse
        fields = ('user', 'course', 'paid', 'date', 'course_det')
