#!/bin/sh 
echo "Creating necessary files and directories..."  
touch controllers/login.php
touch controllers/register.php
touch controllers/dashboard.php
touch controllers/logout.php
touch controllers/profile.php
touch controllers/bookings.php
touch controllers/parking_lots.php
touch controllers/contact.php

touch views/login.view.php
touch views/register.view.php
touch views/dashboard.view.php
touch views/logout.view.php
touch views/profile.view.php
touch views/bookings.view.php
touch views/parking_lots.view.php
touch views/contact.view.php
echo "Files and directories created successfully."