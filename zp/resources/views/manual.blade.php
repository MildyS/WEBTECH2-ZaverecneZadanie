@extends('layouts.app')

@section('content')
    <style>
        @font-face {
            font-family: 'DejaVu Serif';
        }

        /* Additional styling for elements using the font */
        body {
            font-family: 'DejaVu Serif', serif;
        }
    </style>
    <div class="container">
        <h3>Manuál</h3>
        <p>
            Webový portál slúži na evidenciu učiteľov a študentov. Pre používanie je potrebná registrácia a následné prihlásenie. Pokiaľ používateľ nie je prihlásený nemá prístup do portálu. Má možnosť sa prihlásiť alebo zaregistrovať.
            Pri registrácií je potrebné zadať meno, emailovú adresu používateľa, minimálne 8 miestne heslo a zvoliť rolu, pod ktorou sa chce zaregistrovať.
        </p>
        <p>
            Používateľ sa môže zaregistrovať ako študent alebo učiteľ.
        </p>
        <p>
            Po úspešnej registrácií je používateľ automaticky prihlásený do portálu.
        </p>
        <p>
            Ak sa prihlási ako študent má možnosť:
            <ul>
                <li>otvoriť si tento manuál</li>
                <li>odhlásiť sa z portálu</li>
                <li>začať test</li>
            </ul>
        </p>
        <a href="{{ route('manual.pdf') }}" class="btn btn-primary">Download PDF</a>
    </div>

@endsection

<style>
    h3{
        color: #e5e7eb;
        font-weight: bolder;
    }

    li, p{
        color: #e5e7eb;
    }
</style>
