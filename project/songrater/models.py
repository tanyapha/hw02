from tkinter import CASCADE
from turtle import mode
from django.db import models

class Users(models.Model):
    username = models.CharField(max_length=255, 
                                primary_key=True,
                                unique=True)
    password = models.CharField(max_length=255)

    def __str__(self):
        return self.username

class ArtistInformation(models.Model):
    artist_name = models.CharField(max_length=255, unique=True, primary_key= True)
    birth_day = models.DateField()

class Artist(models.Model):
    song = models.CharField(max_length=255, unique=True, primary_key= True)
    artist = models.ForeignKey(ArtistInformation, on_delete= models.CASCADE)

    def __str__(self):
        return self.song

class Ratings(models.Model):
    username = models.ForeignKey(Users, on_delete = models.CASCADE)
    song = models.ForeignKey(Artist, on_delete= models.CASCADE)
    rating = models.IntegerField(max_length=1)

class Albums(models.Model):
    title = models.CharField(max_length=255)
    artist = models.ForeignKey(ArtistInformation, on_delete=models.CASCADE)
    release_date = models.DateField()
    number_of_songs = models.IntegerField()

