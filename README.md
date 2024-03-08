## Canoe Tech Assessment for Remotely

### Instructions for building the application:

You should have the following installed in your machine:
- docker
- docker-compose
- make

Once you cloned the repository, you should run:
- make run

If the migration step fails with something like "SQLSTATE[HY000] [2002] Connection refused", wait some seconds and run it again - that's the DB container building up

That will execute all the necessary commands in order to have the application up and running

- Make sure the .env was created based on .env.example

You also have the option run them individually:
- make run-composer-install
- make run-migrations (Very interesting if you want a fresh database because it will refresh all tables and data)

Once that's done, you can use the attached collection and perform the necessary requests.

### API:

You can see the documentation for the API here:

https://documenter.getpostman.com/view/464920/2sA2xh2CSz#3684c6b6-7af9-40be-947e-eee98c047247

### Additional Information:

- During the app building, there is a bunch of seeds that will save some additional data to the database
- For the task #3, the event-driven process will be running and once a possible duplicated fund is **created** (It doesn't work for updates), it will save a log record to *storage/logs/laravel.log*.
- The data for every entity is NOT validated (It wasn't required in the assessment and I wanted to save some time), therefore operations that need key integrity will fail.
- I've added some additional instructions in the Postman documentation above

### Entity Relationship Diagram:

![er-diagram.png](..%2F..%2F..%2FDesktop%2Fer-diagram.png)
