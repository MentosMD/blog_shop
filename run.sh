#!/bin/bash

cd Bookshop;
php artisan serve &
cd frontend.shop.admin; npm run dev