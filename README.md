# Laravel-Vorlage

Dies ist eine Vorlage für Laravel 8.x Projekte.

## Git

Um das Projekt mit leerer Git-Historie in ein neues Git-Repo zu übernehmen kann man folgenden Befehl ausführen:

    bin/gitChangeRemote.sh

Dieses verlangt die Eingabe einer neuen Repo-Url und erzeugt einen ersten Init-Commit.

## Ordnerstruktur

### bin

Heimat von Hilfs-Skripten

### conf/nginx/nginx.conf

Configurationsdatei für den nginx-Container

### www

Das ist der Ordner für den Document Root. Hier liegen die Laravel-Dateien.

### .env

Konfigurationsdatei sowohl für die Container, als auch für die Laravel-Instanz.

## Starten des Projekts

- Anpassung der .env-File
- Starten des Container-Stacks, entweder:
    - Produktiv: keine Binds

            docker-compose up -d
    - Development: der Ordner www wird in den Container gemountet und es wird ein Adminer-Container mitgestartet

            docker-compose -f docker-compose.yml -f docker-compose.dev.yml up -d

        Dann muß im Ordner www oder im app-Container noch ein Composer-Update durchgeführt werden:

            composer update
- Entwickeln der Seite ;-)

## Quellen
 - https://www.digitalocean.com/community/tutorials/how-to-containerize-a-laravel-application-for-development-with-docker-compose-on-ubuntu-18-04-de