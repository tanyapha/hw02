from django.shortcuts import render, get_object_or_404
from django.http import HttpResponse, Http404

from .models import Users, Ratings, Artist, Albums

# User Registration "home" page – displays user registration interface

def ifExist(output, label, message):
    if output[label].count() == 0:
        return {label+'_error':message}
    else:
        output

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
        rating = Ratings.objects.filter(username_id=username_input).values("song_id","rating")
        if rating.count() == 0:
            context["ratings_error"] = "No username found"
        else:
            context["ratings"] = rating
    elif 'retrieve-by-artist' in request.POST:
        artist_input = (request.POST.get('artist-name')).title()
        artist_albums = {"artist": artist_input,'albums':Albums.objects.filter(artist_id = artist_input).values("title","number_of_songs")}
        if artist_albums['albums'].count == 0:
            context["albums_error"] = 'No albums found'
        else:
            context = artist_albums
    return render(request, 'home.html', context)