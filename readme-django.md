# Problem 2 : Songrater App (Django)

The songrater app for COMP333 Software Engineering.

## Setup

From within the project directory, run the Songrater App with: (If you are using the fish shell, run `source my-venv/bin/activate.fish`)

```shell
python3 -m venv my-venv
source my-venv/bin/activate
```

To install Django in virtual environment

```shell
python3 -m pip install Django
python3 -m pip install djangorestframework
python3 -m pip install django-cors-headers
```

To start server

```shell
python3 manage.py runserver
```

Then, in your browser, go to:

```url
http://127.0.0.1:8000/songrater
```

## Testing

To test the Retrieve Albums by an Artist try

1. Taylor Swift
2. Bruno Mars
