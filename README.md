# Birthdays
A Simple PHP Site To List Birthdays, Next Birthday, and More Information.

To build:

docker build -t birthdays --build-arg DATABASE_HOST=localhost --build-arg DATABASE_USER=dbuser --build-arg DATABASE_PASSWD=dbpasswd --build-arg DATABASE_DB=birthdaydb .

docker run -d --name=birthdays -p 8000:80 --restart unless-stopped birthdays

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
