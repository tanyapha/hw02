from django.shortcuts import render, get_object_or_404
from django.http import HttpResponse, Http404

from .models import Users, Ratings, Artist

# User Registration "home" page – displays user registration interface

def home(request):
    context = {'message':''}
    if request.method == "POST":
        name_count = Users.objects.filter(username=request.POST['Username']).count()
        if name_count == 0:
            user=Users(username = request.POST['Username'], password = request.POST['Password'])
            user.save()
            context = {'message':'Successfully registered.'}
        else:
            context = {'message':'This username already exists.'}
    return render(request, 'home.html', context)

def retrieval(request, username_id):
    ratings = get_object_or_404(Ratings, pk=username_id)
    try:
        ratings = Ratings.objects.get(pk=username_id)
    except Ratings.DoesNotExist:
        raise Http404("Username does not exist")
    return render(request, 'home.html', {'ratings': ratings})
