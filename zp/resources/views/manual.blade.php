@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Manuál</h3>
        <div>
            <p>
                Webový portál slúži na evidenciu učiteľov a študentov. Pre používanie je potrebná registrácia a následné prihlásenie. Pokiaľ používateľ nie je prihlásený nemá prístup do portálu. Má možnosť prihlásiť sa ,zaregistrovať sa alebo zobraziť tento manuál a exportovať ho do PDF.
            </p>
            <p>
                Používateľ sa môže zaregistrovať ako študent alebo učiteľ.
            </p>
            <p>
                Po úspešnej registrácií je používateľ automaticky prihlásený do portálu.
            </p>
        </div>
        <br>
        <div>
            <p>
                <h4>Študent</h4>
                <span>Ak sa používateľ prihlási ako študent má možnosť:</span>
                <ul>
                    <li>Zobraziť informačný panel</li>
                    <li>Začať test</li>
                    <li>Odhlásiť sa z portálu</li>
                </ul>
            </p>
            <h5>Zobrazenie informačného panelu</h5>
            <p>
                Informačný panel sa zobrazí po stlačení názvu „Záverečné zadanie“. Nachádzajú sa na ňom súbory potrebné pre začatie testu a informácia o odovzdaných testoch.
            </p>
            <h5>Začatie testu</h5>
            <p>
                Ak chce používateľ začať test, najskôr si zvolí súbory (najmenej jeden), z ktorých chce mať vygenerovaný príklad. Z každého súboru sa vygeneruje jeden náhodný príklad. Následne používateľ musí stlačiť tlačidlo „Začať test“ .  Webový portál následne zobrazí obrazovku s testom.
            </p>
            <p>
                Tam sa nachádza zadanie príkladov, virtuálna klávesnica, pomocou ktorej je potrebné zapísať výsledok a tlačidlo na odoslanie testu.
            </p>
            <p>
                Po odoslaní sa používateľovi zobrazí výsledok z testu a tlačidlo pre návrat na informačný panel. Na tejto obrazovke sa používateľ dozvie koľko bodov získal a aj počet bodov , ktoré mohol získať.
            </p>
        </div>
        <br>
        <div>
            <p>
                <h4>Učiteľ</h4>
                <span>Ak sa používateľ prihlási ako učiteľ má možnosť:</span>
                <ul>
                    <li>Zobraziť zoznam študentov, výsledky študentov</li>
                    <li>Zobraziť nahraté súbory, zmazať ich, zverejniť a skryť</li>
                    <li>Zobraziť nahrané obrázky a zmazať ich </li>
                    <li>Pridať LaTeXový súbor </li>
                    <li>Pridať obrázok </li>
                    <li>Exportovať vybrané údaje do CSV</li>
                    <li>Odhlásiť sa z portálu</li>
                </ul>
            </p>
            <div>
                <h5>Zobrazenie zoznamu študentov, nahratých súborov a obrázkov, export do CSV</h5>
                <p>
                    Po prihlásení sa používateľovi zobrazí obrazovka na ktorej sa nachádza informáciou o všetkých študentoch, ich výsledky z testov a možno exportovať údaje do CSV.
                <p>
                    Do CSV sa exportujú všetky odovzdané zadania študentov, zoznam všetkých zaregistrovaných študentov, nahraté LaTeXové súbory a príklady z daných súborov.
                </p>
                <p>
                    Nahraté súbory , ktoré môže vymazať, skryť a nastaviť dátum automatického zverejnenia a nahraté obrázky, ktoré môže vymazať.
                </p>
            </div>
            <br>
            <div>
                <h5>Pridanie LaTeXových súborov a obrázkov</h5>
                <p>
                    Ak chce používateľ pridať súbor alebo obrázok klikne na „Pridanie súborov“.
                </p>
                <p>
                    Následne sa mu zobrazí obrazovka na nahratie LaTeXových súborov. Tu má možnosť vybrať súbor, ktorý chce nahrať, prideliť body za jeden príklad, ktorý bude vygenerovaný z vybraného súboru.  Ak sa rozhodne vybrané súbory pridať stlačí tlačidlo „Pridať súbory“.
                </p>
                <p>
                    Pri nahrávaní obrázkov klikne na tlačidlo „Vybrať súbor“ a vyberie obrázok, ktorý chce nahrať. Následne používateľ môže stlačiť tlačidlo „Pridať obrázky“ pre nahratie obrázkov.
                </p>
            </div>
        </div>
        <br>
        <div>
            <p>
                <h4>Odhlásenie používateľa z portálu</h4>
            <p>
                Ak sa chce používateľ odhlásiť klikne na svoje meno a zobrazí sa mu drop-down list s možnosťou odhlásenia. Po úspešnom odhlásení je používateľ presmerovaný na registráciu.
            </p>
            </p>
        </div>
        <br>
        <a href="{{ route('manual.pdf') }}" class="btn btn-primary">Download PDF</a>
    </div>

@endsection

<style>
    h3,
    h5 {
        color: #e5e7eb;
        font-weight: bolder;
    }

    h5{
        text-decoration: underline #e5e7eb solid;
    }

    h4{
        color: #da3c8b;
    }

    li,
    p,
    span{
        color: #e5e7eb;
    }
</style>
