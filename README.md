# todolist-sql

# How to use
just run docker-compose up (-d to run it in background)
- you can acces your site on localhost
- you can acces phpMyAdmin on localhost:8080 with  root (user:root , password:password) or another profile that you define.
- all your file have to be in the www/ folder.

# What's inside
 - PHP 7.4
 - MYSQL:latest
 - PHPMYADMIN:latest
 
 # Common problems
 
 - If you have sql or apache2 running locally the stack will conflict with those so you have to stop the two processes (service apache2 stop, service mysql stop).
