# Berlin forecast

Symfony project to show next 5 day's forecast for Berlin ( Limited Trial )

Data from [AccuWeatherAPIs](https://developer.accuweather.com/apis)

Database Schema (https://drive.google.com/file/d/1uYA1Ejsf28a8x6ROTfJv_gR_8pehPOFE/view?usp=sharing)

**Tech Stack**:
* Symfony 4.3.4
* DB MySQL

## How to run it

Commands for Linux bash:

1. **git clone** *this_repository*

  1. **cd** *repository_directory*

  1. **composer install**

1. edit .env file for the DB connection

1. edit HomeController and set $apiKey variable with *your_apiKey*

1. **symfony server:start**

1. http://127.0.0.1:8000/home


