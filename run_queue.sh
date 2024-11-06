#!/bin/bash

# Check if gedit is running
# -x flag only match processes whose name (or command line if -f is
# specified) exactly match the pattern. 

if pgrep -f "php /app/artisan queue:work redis" > /dev/null
then
    echo "Running"
    php /app/artisan queue:restart
    php /app/artisan queue:work redis  &
    pwd
else
    php /app/artisan queue:work redis  &
    pwd
fi
