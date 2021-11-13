### Overview

A ticketing software where users can raise tickets to request features or report bugs. 
once a ticket is raised it must be accpeted or rejected by a manager 
tickets have a discussion section with the ability to post comments 
documents can also be uploaded/downloaded to and from the ticket.
tasks can be added and assigned to users in the ticket. once a task is 
assinged to the user it appears in their tasks with target date to complete

approvers are added by the developer to the ticket once the ticket 
is ready to be completed. once the approvers have all approved the ticket 
the ticket can be completed

redis mailing queue is used to dispatch emails 
on certain events that occur within the ticket 
e.g developer is assigned a ticket then an email will be sent to the developer etc.



### Usage

Using docker to get started

``` bash
docker-compose up --build 
```

migrate the tables and seed 
``` bash
docker-compose run --rm artisan migrate --seed  
```

should be running on localhost:8000


------------


##### Accounts 

password = password

- admin = admin@admin.com
- manager = manager@manager.com
- developer = developer@developer.com 
- employee = john@doe.com