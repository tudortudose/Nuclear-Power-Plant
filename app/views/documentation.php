<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Nuclear PowerPlant Web Manager Scholarly HTML Report</title>

    <link rel="stylesheet" href="https://w3c.github.io/scholarly-html/css/scholarly.min.css">
    <script src="https://w3c.github.io/scholarly-html/js/scholarly.min.js"></script>
</head>
<body>
<header>
    <div class="banner">
        <img style="width: 100%" src= "http://localhost/NuclearGitProject/Nuclear-Power-Plant/public/doc/resources/scholarly-html.svg" width="227" height="50" alt="Scholarly HTML logo">
    </div>
    <h1><project>Nuclear PowerPlant Web Manager</project> Raport - Scholarly HTML</h1>
</header>

<div role="contentinfo">
    <dl>
        <dt>Authors</dt>
        <dd>
            <a>Pricop Tudor-Constantin</a>,
            <a>Tudose Tudor Cristian</a>
            <a>Ungureanu Alexandra Maria</a>
        </dd>
    </dl>
</div>
<section typeof="sa:Abstract" id="abstract" role="doc-abstract">
    <h2>Abstract</h2>
    <p>
        Documentul de fata integreaza astectele tehnice si modul de interactiune al utilizatorului cu proiectul Nuclear PowerPlant Manager
        realizat in cadrul cursului de <web>Tehnologii Web</web>, realizat in coloborare de
        <a>Pricop Tudor-Constantin</a>, <a>Tudose Tudor Cristian</a> si <a>Ungureanu Alexandra Maria</a>.
        <br>
        <br>
        <infoiasi><i>Universitatea Alexandru Ioan Cuza din Iasi, Facultatea de Informatica</i></infoiasi>
    </p>
</section>

<section id="introduction" role="doc-introduction">
    <h2>Introducere</h2>
    <section id="purpose">
        <h3>Scop</h3>
        <p>
            Aplicatia Nuclear PowerPlant Web Manager ofera utilizatorului posibilitatea de a administra intr-un mediu virtual o retea 
            de centrale nucleare. User-ul va putea amplasa pe o harta un numar de centrale a caror pozitionare va tine cont de gradul de 
            risc pe care locatia specifica il prezinta. Starea curenta a centralelor va putea fi verificata si modificata in timp real, 
            iar alertarea in legatura cu evenimentele majore va fi realizata pe site si prin email-uri. 
        </p>
    </section>

    <section id="purpose">
        <h3>Viziune</h3>
        <p>
            Aplicatia curenta isi doreste sa reprezinte o modalitate facila de invatare a procesului de administrare a centralelor nucleare,
             cu riscurile aferente existentei lor, dar si cu actiunile mandatorii de intretinere a acestora, lucru obtinut prin 
             generarea automata de statistici cu privire la starea curenta a centralelor.
        </p>
    </section>

</section>

<section id="description" role="doc-description">
    <h2>Descriere</h2>

    <section id="perspective">
        <h3>Perspectiva</h3>
        <p>
            Un simulator de coordonare a unei retele de centrale nucleare.
        </p>
    </section>

    <section id="functionalities">
        <h3>Functionalitatile oferite</h3>
        <p>
            Din punct de vedere functional, aplicatia pune la dispozitie urmatoarele:
        </p>
        <ul>
            <li>Inregistrarea unui utilizator prin crearea unui cont si posibilitatea de logare ulterioara cu acesta</li>
            <li>Amplasarea dinamica de centrale nucleare pe o harta reala a lumii in functie de caracteristicile locatiei</li>
            <li>Introducerea de informatii referitoare la fiecare centrala adaugata</li>
            <li>Pastrarea persistenta a datelor introduse</li>
            <li>Notificarea utilizatorului in legatura cu intamplari exceptionale referitoare la centrale direct pe site 
                sau prin email
            </li>
            <li>Prezentarea statusului curent al centralelor prin statistici si rss, dar si starea curenta a vremii in locatia
                respectiva
            </li>
        </ul>
    </section>

    <section id="systemoperation">
        <h3>Mediul de operare</h3>
        <p>
            Aplicatia poate rula pe orice browser modern, deci pe orice sistem de operare ce suporta un asftel de browser.
            De asemenea, in cazul rularii pe un sistem de operare specific unui smartphone, contentul este responsive pentru dimensiunile
            reduse a acestuia.
        </p>
    </section>

    <section id="constraints">
        <h3>Constrangeri</h3>
        <p>
            Nuclear PowerPlant Manager depinde direct de API-ul furnizat de Google Maps. In cazul in care acesta sufera modificari de
            permisiuni sau functionalitati, aplicatia va fi direct afectata de aceasta, el aflandu-se la baza site-ului curent.
            De asemenea, ea depinde si de un Weather API
            (Interactive API Explorer) pentru a furniza informatii referitoare la vreme in functie de pozitia centralei, iar in cazul in
            acesta are probleme, aplicatia NuP nu va furniza corect datele mentionate anterior.
        </p>
    </section>

</section>

<section id="interfaces" role="doc-interfaces">
    <h2>Interfete externe</h2>

    <section id="userinterface">
        <h3>Interfata pentru utilizator</h3>
        <p>
            Interfata aplicatiei este una moderna si intuitiva, adaptata astfel incat sa faca experienta utilizatorului cat 
            se poate de facila. Nuclear PowerPlant Web Manager poate fi folosit atat pe ecrane mari, cat si pe ecrane de dimensiuni mai reduse,
            cum ar fi cel de tableta sau mobil, lucru datorat design-ului responsive integrat.
        </p>
    </section>

    <section id="softwareinterface">
        <h3>Interfata software</h3>
        <p>
            Un aspect important al aplicatiei este dat de API-ul de la Google Maps. Acesta este folosit intensiv pentru a adauga centrale 
            nucleare in aplicatie. Odata adaugate pe harta, locatia acestora, data de API la momentul pozitionarii, si informatiile 
            aferente sunt stocate intr-o baza de date, 
            care va fi interogata la momentul relogarii utilizatorului pe site pentru ca datele introduse pana la momentul respectiv 
            sa fie afisate ca in momentul adaugarii lor. <br><br>

            Sistemul de management al bazei de date ales este MySQL, aceasta fiind printre cele mai sigure si de incredere sisteme de 
            acest fel, scalabilitatea la cerere fiind un alt punct forte in acest caz. <br><br>

            Modelul arhitectural folosit este cel de Model View Controller, deoarece limiteaza duplicarea de cod si separa partea de date
            de cea de logica business. Componenta controller este asociata partii de server si se ocupa cu autentificarea si logarea
            utilizatorilor, validand totodata si datele de intrare. De asemenea, aceasta se ocupa si cu managerierea diferitelor pagini
            din aplicatie pentru o organizare si incarcare eficienta a acestora. Componenta model este cea care comunica cu baza de date, 
            realizand interofarile necesare. Componenta view se ocupa cu ceea ce vede si interactioneza direct utilizatorul, implicand
            in cazul de fata harta si modul de adaugare a centralelor, paginile de logare, about si feed-ul rss. <br><br>

            Pentru crearea front-end-ului au fost folosite HTML5, CSS si Javascript, fara alte librarii ajutatoare. Pentru crearea 
            back-end-ului a fost utilizat PHP si Javascript.

        </p>
    </section>

    <section id="userinterface">
        <h3>Interfata de comunicare</h3>
        <p>
           Aplicatia este impartita in sase microservicii:
           <ul>
                <li>
                    Server: are ca scop principal manipularea datelor din baza de date si controlul paginilor care intra in componenta 
                    aplicatiei.     
                </li>
                <br>
                <li>
                    Autentificare: microserviciul de autentificare se ocupa cu partea de login si inregistare a unui user
                    in aplicatie. Ea preia
                    datele de conectare introduse si face un request catre server pentru validare sau introducere a datelor.
                    Pentru securizarea acestor informatii in aplicatie au fost folosite JWT-uri. De asemenea, 
                    pentru fiecare conectare a unui utilizator va fi creata o sesiune care va ramane activa pana la deconectarea utilizatorului. 
                </li>
                <br>
                <li>
                    Management centrale: acest microserviciu se ocupa cu coordonarea intregii retele de centrale amplasate pe harta, de la 
                    introducerea informatiilor aferente in sistem pana la vizualizarea si amplasarea centralelor pe o harta, care este asigurat prin API-ul 
                    de la Google Maps, care ofera user-ului posibilitatea de a interactiona dinamic cu harta si de a avea o 
                    reprezentare in conformitate cu viata reala. Cu ajutorul acestei harti, se preiau datele legate de locatia unde este 
                    amplasata centrala si astfel se pot face si anumite estimari legate de gradul de risc al pozitionarii respective 
                    (eg. numarul de orase din vecinatate creste gradul de risc al locatiei si implicit al centralei).
                </li>
                <br>
                <li>
                    Monitorizare individuala centrale: se ocupa cu observarea si configuarea fiecarei centrale in parte. 
                    La apasarea unei centrale pe harta se va putea deschide o noua pagina de control cu informatii importante despre aceasta, 
                    inclusiv puterea de racire, temeperatura nucleului, puterea energiei si puterea ceruta, dar si puterea produsa care 
                    este calculata in functie de elementele anterioare. In acest loc vor putea fi aduse modificari unor parametri mentionati anterior, 
                    dar se va putea, de asemenea, vizualiza vremea in locatia centralei, data prin Weather API-ul de la Interactive APIs, si anumite 
                    statistici referitoare la modul de functionare al instalatiei. 
                </li>
           </ul> 
        </p>
    </section>


</section>

<section id="functionalitiesexplained" role="doc-interfaces">
    <h2>Functionalitati</h2>

    <section id="register">
        <h3>Inregistrarea</h3>
        <p>
            Procesul de inregistrare presupune crearea unui cont de utilizator prin completarea campurilor necesare: utilizator, 
            nume, prenume, email si parola. Dupa apasarea butonului de "register" si validarea email-ului si formatului de parola, 
            datele sunt introduse in baza de date, parola ajungand sa fie criptata, iar contul de utilizator este creat, 
            user-ul fiind redirectionat catre pagina de logare.
        </p>
    </section>

    <section id="login">
        <h3>Logarea</h3>
        <p>
            Procesul de logare presupune introducerea email-ului si al parolei si apasarea butonului de login. In cazul in care 
            exista un cont asociat email-ului introdus, iar parola este cea corecta, se creeaza o sesiune pentru acel user, care 
            va fi redirectionat catre pagina Home.
        </p>
    </section>

    <section id="map">
        <h3>Harta</h3>
        <p>
            Prin selectarea optiunii de Map din bara de navigatie, userul ajunge in pagina de harta realizata in spate cu ajutorul 
            API-ului de la Google Maps. Aceasta este o harta adevarata pe care utilizatorul poate amplasa centrale nucleare printr-un 
            click al butonului de "Add nuclear power plant". In acel moment ii va aparea o caseta in care i se va indica sa introduca 
            numele, numarul de reactoare si puterea fiecarui reactor. Dupa completarea acestor informatii, el va putea alege locul de
            pe harta unde doreste sa-i fie amplasata centrala, avand posibilitatea ca ulterior sa-i modifice locatia printr-un drag 
            and drop. Toate aceste date sunt stocate intr-o baza de date locala care va permite ulterior reincarcarea acestor informatii. 
            La apasarea unei iconite reprezentand o centrala, acesta poate vizualiza informatii despre ea, inclusiv statistici 
            generate automat pe baza informatiilor existente si vremea la locatia respectiva, oferita, de asemenea, printr-un API. 
            In cazul in care exista probleme majore cu una din centrale, user-ul va fi 
            notificat atat pe site, cat si printr-un email. 
        </p>
    </section>

    <section id="stats">
        <h3>Statistici</h3>
        <p>
           Componenta de statistici a fost realizata pentru a oferi utilizatorului grafice cu informatii importante despre 
           activitatea fiecarei centrale si a reactoarelor sale. Primul grafic prezinta vremea pentru toate zilele cand centrala 
           a fost functionala. Al doilea grafic concentreaza indicii de nivel pentru puterea de racire, temeperatura nucleului 
           si puterea energiei in ultimele 30 de zile. Al treilea grafic indica o compratie intre puterea ceruta si puterea produsa 
           pentru a face un status in legatura cu productivitatea centralei, iar cel de al patrulea grafic se ocupa cu starea curenta 
           de functionare a centralei pentru a determina necesitatea unei reconfigurari sau a unei reparatii. Toate statisticile vor putea 
           fi salvate ulterior de catre utilizator sub forma de imagini cu extensia png.

           <br><br>
           <img style="width: 100%" src= "http://localhost/NuclearGitProject/Nuclear-Power-Plant/public/doc/resources/comparison.png" width="227" height="350" alt="Scholarly HTML logo">
           <br><br>
           <img style="width: 100%" src= "http://localhost/NuclearGitProject/Nuclear-Power-Plant/public/doc/resources/functionality.png" width="227" height="350" alt="Scholarly HTML logo">
           <br><br>
           <img style="width: 100%" src= "http://localhost/NuclearGitProject/Nuclear-Power-Plant/public/doc/resources/health.png" width="227" height="350" alt="Scholarly HTML logo">
           <br><br>
           <img style="width: 100%" src= "http://localhost/NuclearGitProject/Nuclear-Power-Plant/public/doc/resources/reactors_health.png" width="227" height="350" alt="Scholarly HTML logo">
        </p>
    </section>

</section>

<section id="functionalitiesexplained" role="doc-interfaces">
    <h2>Performanata</h2>
    <p>
        La capitolul performanta, aplicatia a obtinut un scor de ... pe aplicatia Measure.
    </p>
</section>