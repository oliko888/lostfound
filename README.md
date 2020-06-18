# Veebilehekülg: Tallinna ülikooli “Lost & Found”

## Ekraanipildid tava ja mobiilses vaates veebilehest


![Screenshot (275).png](https://github.com/oliko888/lostfound/blob/master/Screenshot%20(275).png)

![Screenshot (279).png](https://github.com/oliko888/lostfound/blob/master/Screenshot%20(279).png)

![Screenshot (286).png](https://github.com/oliko888/lostfound/blob/master/Screenshot%20(286).png)

![Screenshot (288).png](https://github.com/oliko888/lostfound/blob/master/Screenshot%20(288).png)

![Screenshot (289).png](https://github.com/oliko888/lostfound/blob/master/Screenshot%20(289).png)

![Screenshot (290).png](https://github.com/oliko888/lostfound/blob/master/Screenshot%20(290).png)

![Screenshot (291).png](https://github.com/oliko888/lostfound/blob/master/Screenshot%20(291).png)


## Eesmärk ja lühikirjeldus

Projekti eesmärgiks oli luua “Lost & Found” veebilehekülg Tallinna Ülikooli jaoks, et aidata kiirelt ja mugavalt tagastada inimestele asjad, mis nad on ära kaotanud Tallinna Ülikooli territooriumil.

Töö on tehtud Tallinna Ülikooli Digitehnoloogiate instituudi informaatika eriala suvepraktika raames .

## Tehnoloogiad

Laravel 7.2.1 raamistik

MySQL

Apache HTTP server

PHP

## Meeskond  

Oliver Kobing

Nina Katarina Weiss

Liisi Liivik

Maris Jool

## Installeerimisjuhend
1. GitHubi repositooriumi lokaalne kloonimine - Looge arvuti kõvakettale kaust, kuhu soovite projekti salvestada. Terminaalis on vaja allolevat käsk sisestada, mis  tõmbab projekti GitHubist alla ja loob koopia sellest lokaalse arvuti peale kausta nimega projectName. Soovil korral on võimalik nime muuta, kui koodilõigust,mis asub peale kaldkriipsu, viimast osa muuta.
git clone linktogithubrepo.com/ projectName
Repositooriumilinki saab GitHubi lehel paremal olevat “clone or download” nuppu vajutades. Avaldatud URL tuleb asendada siin etteantud koodilõigust linktogithubrepo.com’iga.

2. cd projekti sisse - Et järgmised sammud juhendis töötaksid, on vaja just loodud projektifaili siseneda. Selleks on vaja terminalis trükkida cd projectName, või mistahes antud nimi.

3.  Composer Dependencies installeerimine - Järgmise sammuna on vaja composer’it installeerida. Selleks tuleb terminaali kirjutada :  composer install

4. NPM Dependencies installeerimine - Samamoodi kui eelnevas sammus kirjeldatud composer’i installeerimine, on ka vaja NPD’sid installeerida.Selleks tuleb terminaale kirjutada: npm install

5. .env failist koopia tegemine - Andmebaasi konfigureerimise jaoks on vaja  .env.example template’is koopiat teha, et uue  .env faili luua. Selleks tulebe terminaalis kirjutada :   cp .env.example .env

6. App encryption key genereerimine - Selleks et app saaks elemendid nagu cookies’id või parooli hash’it kodeerida vajab ta ühte encryption key’t. Selle loomiseks tuleb terminaalis kirjutada:  php artisan key:generate
Kui nüüd  .env faili vaadata, siis tekkis sinna üks pikk String  APP_KEY field’sis.

7. Tühja andmebaasi loomine - Nüüd on vaja uue andmebaasi luua eelistatud andmebaasi tools’idega. Nimeks saab talle näiteks “test” panna.

8. Andmebaasi informatsioone .env failile kirjutamine,et andmebaasi ühendada - Varem loodud  .env failis on nüüd vaja DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, ja  DB_PASSWORD vastavalt andmebaaside väärtuste täita.

9. Andmebaasi migreerimine - Selleks, et andmebaasi migreerida  on vaja terminalis kirjutada:  php artisan migrate
 

## Litsents

-->[Litsents](https://github.com/oliko888/lostfound/blob/master/MIT%20litsents%20(MIT%20license))<--

## Lingid veebilehtedele

-->[VEEBILEHEKÜLG](https://epo.ee/lostfound/)<--

-->[BLOGI](http://suvepraktika.cs.tlu.ee/2020/ryhm07/)<--  

