from django.shortcuts import render, get_object_or_404
from django.http import HttpResponse, Http404

from .models import Users, Ratings, Artist, Albums

# User Registration "home" page – displays user registration interface

def home(request):
    context = {'message':''}
    if 'register' in request.POST:
        username_input = request.POST.get('username-register')
        name_count = (Users.objects.filter(username=username_input)).count()
        if name_count == 0:
            user = Users(username = username_input, password = request.POST.get('password'))
            user.save()
            context = {'message':'Successfully registered.'}
        else:
            context = {'message':'This username already exists.'}
    elif 'retrieve' in request.POST:
        username_input = request.POST.get('username-songs')
        ratings = Ratings.objects.filter(username_id=username_input).values("song_id","rating")
        # val = request.POST
        context = {'ratings':ratings}
    elif 'retrieve-by-artist' in request.POST:
        artist_input = request.POST.get('artist-name')
        context = {'albums':Albums.objects.filter(artist_id = artist_input).values("title","number_of_songs")}
    return render(request, 'home.html', context)
def retrieval(request, username_id):
    username_input = request.POST.get('username-songs')
    ratings = Ratings.objects.filter(username_id=username_input)
    # try:
    #     ratings = Ratings.objects.get(username_id=username_id)
    # except Ratings.DoesNotExist:
    #     raise Http404("Username does not exist")
    return render(request, 'home.html', {'ratings': ratings})