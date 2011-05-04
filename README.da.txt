Danish translation of Drupal interface strings.

Copyright 2004-2008 Morten Wulff <wulff@ratatosk.net>

Based on the wordlist provided by Commercial Linux Association of Denmark (KLID, http://www.klid.dk/dansk/ordlister/ordliste.html), SSLUG (Skåne Sjælland Linux User Group, http://www.sslug.dk/locale/oversaet/ordlister/) and It-terminologi-udvalget (http://www.it-dansk.dk/).


CONTRIBUTORS

Lennart Kiil <lennart@zensci.com>
Bjarne Andersen <bjarne@6400.net>
Frederik 'Freso' S. Olesen <freso.dk@gmail.com>
Steven Snedker <ss@vertikal.dk>


TRANSLATED MODULES

Please see the localization server at http://drupal.l10n.dk/ for the current translation status of contributed modules. If your favorite module is not on the list, please contact me and I'll add it to the list.


TODO

forældreløse -> løsrevne
billedpunkter -> pixels
overførsel -> upload
Vocabulary / ordforråd, kategori :P AAARGH - tjek på live install
Specifik -> bestemt?
Brugere -> brugerne
relaterede -> beslægtede
Indholdselement -> node?
Skift katalog -> mappe?
bruge <en module name>-modulet (ses kun af admins og devs)

Term -> ?

Tilgå -> se / vis?
Outline -> ?
Mellemlager -> cache
Smagsprøve -> Resumé / Sammendrag?
Views -> Oversigt (især panels.module)
Privat downloads: core vs. imagecache
URL path settings -> URL sti indstillinger / Alternativ URL? (node.module)
drupal.module: register you server -> tilmelde din server
fjern din/dit?

forum.module
  Nyt %type %term oprettet. -- Kan gå galt afhængigt af indholdet af %type

configuration settings -> konfigurationsindstillinger?
brugere vs. brugerne*
	brugere: brugere generelt
	brugerne: brugerne af netstedet
arkiv vs. arkiver?
dit netsted vs. netstedet
can be enabled via the <a href=\"%menu-module\">menu management</a> page / enabled under -> aktiveres via menusiden / aktiveres på menusiden ?
on the <foo> page, you can <bar> -> under <foo> kan du <bar>
if enabled -> hvis dette/denne aktiveres ? skal det med i en oversættelse?

attachment: vedhæftet vs. bilag
menu.module: administration -> administer
             > admin -> >administer
x's vs. xs
url alias vs. url omskrivning
phrase -> udtryk

fjern denne/dette (for inaktivt)

læs siden om... : note om at der henvises til en engelsk side?

archive.module "to view the archive by date" dobbeltkonfekt?

allows x to... y -> x kan y

throttle modulet vs. begrænsningsmodulet

watchdog.module: are help links up-to-date? admin/logs vs. admin/watchdog + admin/watchdog/events
	TIME TO SYNC handbook and admin help texts?


SQL

Run the following queries to translate the strings from database.mysql

UPDATE role SET name='anonym bruger' WHERE rid=1;
UPDATE role SET name='godkendt bruger' WHERE rid=2;

UPDATE filter_formats SET name='Filtreret HTML' WHERE format=1;
UPDATE filter_formats SET name='PHP-kode' WHERE format=2;
UPDATE filter_formats SET name='Fuld HTML' WHERE format=3;


DICTIONARY

account             konto
add                 tilføj
administer          administration
administrators      administratorer
aggregator          nyhedsaggregator?, feedlæser?
archive             arkiv
article             artikel
author              forfatter
block               blok
blog                blog
book outline        resumé
browse              gennemse
browse archives     gennemse arkiv
categorize          kategoriser
category            kategori
chapter             kapitel
checkboxes          afkrydsningsfelter
child [node]        underordnet (!)
collaborative       fælles
configuration       indstillinger
congestion control  ?
content             indhold
content access permissions ?
create              opret
created             oprettet
delete              slet
directory           mappe (i filsystemet), katalog ("telefonbog")
display mode        visning
displayed           vist
edit                rediger
expanded view       udvidet visning
feed                strøm? / kilde*
flat list           flad liste
forum               forum
forums              forummer
fully-qualified     fuldt kvalificeret
handle              kaldenavn?
help text           hjælpetekst
hit                 besøg / træffer?
home                hjem (?)
input format        inddataformat
interval            interval
item                punkt, element
job                 opgave*
last [reply/items]  seneste
legacy              ?
link                henvisning
log                 log
login               log på
logout              log af
main display        hovedvisning
mean                gennemsnit
menu item           menupunkt
move                flyt
n/a                 ?
navigation menu     ?
never               aldrig
news aggregator     nyhedssamler, nyhedsindsamler?
news feed           nyhedskilde
next                næste
node                indholdselement
node count          indholdstæller
notification        påmindelse
on-the-fly          løbende
operational         funktionel
options             valg(muligheder)
organize            organisere, samle
orphan              forældreløs
orphan page         forældreløs side
outline             føj til bog
overview            oversigt
page                side
parent              (?)
parent [node]       overordnet (!)
permissions         tilladelser
poll                afstemning
post (n.)           indlæg
post (v.)           indsende
post authoring form ?
previous            forrige
printer-friendly    printervenlig
RDF feed            RDF strøm, RDF kilde*
reply               svar
resolve             udrede? system.module
role                rolle
rollback            tilbageføre
RSS feed            RSS strøm, RSS kilde*
screen              skærm
search output       søgeresultat (!)
section             sektion
session             session
settings            indstillinger
severity            grad?
sibling [node]      sideordnet (!)
site-wide           globale
sitemap             ?
story               historie, artikel
string              tekst, streng
submit              gem
submission form     ?
syndicate           udgive
syndicator          ?
system-wide         ?
tab                 faneblad
task                ?
teaser              smagsprøve
theme               tema
thesauri            ?
threaded view       emnevisning
threshold           grænse
throttle            ?
topic               tråd, emne
track               følg?
underscore          ?
unpublish           skjul
update              opdater
URL                 URL
user                bruger
users               brugerne ?
warning             advarsel
watchdog            hændelseslog
weight              vægt
who's online        hvem er online

Initial list of terms from the German translation project.


NOTES

TEST: content_types-inc.po (især <strong>Warning...)

Beholder -> gruppe? (fora)
Konto -> profil?
"" -> <em></em>? (tydeligere på skærmen?)

hosting-firma -> udbyder
MySQL x -> MySQL-x

henvisning -> link
netsted -> site
epost-adresse -> e-mail-adresse
mellemlager -> cache


sitet's (tjek nudansk ordbog)
     ^^

x tilgængelige -> tilgængelige x?

mærker -> tags?

"administratorer..." -> "du kan..."


filer: tilladelser vs. rettigheder?


node access -> adgangsliste?


$Id: README.txt,v 1.11.2.4 2008/08/25 10:29:09 wulff Exp $
