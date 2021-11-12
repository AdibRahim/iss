# Welcome to ISS Locator

Hi! This is my project assessment for NeXT Digital Banking Project. 
The project developed using a PHP language which specifically using a Laravel Framework run on Apache Server. 

Step to run this project:
1. **Windows** 
		Using a Laragon, which is a tools that separate development dependency like Apache, Node, etc.. and personal installation software.
		[Link (Laragon)](https://laragon.org/download/)
		Or You can download setup Manually setup Composer, PHP..
		[Laravel Manual Installation ](https://laravel.com/docs/8.x/installation)

2. Clone a project
`git clone https://github.com/AdibRahim/iss.git`

3. Install and update composer
`composer update`

4. Setup new .env file
`cp .env.example .env`

5. Generate new application key
`php artisan key:generate`

6. Run the project
`php artisan serve`

7. Open on browser
http://127.0.0.1:8000 or pretty url http://iss.test/

