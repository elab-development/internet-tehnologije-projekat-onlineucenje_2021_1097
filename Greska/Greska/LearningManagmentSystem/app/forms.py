from django import forms
from app.models import Course

class CourseForm(forms.ModelForm):
    class Meta:
        model = Course
        fields = ['title', 'description', 'author', 'category','featured_image','featured_video','level','price','discount','status']

