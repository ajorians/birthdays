# Birthdays
A Simple PHP Site To List Birthdays, Next Birthday, and More Information.

To build:

docker build -t birthdays .

docker run -d --name=birthdays --env DATABASE_HOST=myhost --env DATABASE_USER=mydbuser --env DATABASE_PASSWD=mydbpasswd --env DATABASE_DB=mybirthdaydb -p 8000:80 --restart unless-stopped birthdays

Or with Docker-Compose:
version: "3.9"
services:
  webapp:
    build:
      context: .
      dockerfile: ./Dockerfile
    ports:
      - "8000:80"
    environment:
      - DATABASE_HOST=localhost
      - DATABASE_USER=dbuser
      - DATABASE_PASSWD=dbpasswd
      - DATABASE_DB=birthdaydb
    restart: unless-stopped
