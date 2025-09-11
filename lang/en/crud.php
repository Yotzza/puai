<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'robas' => [
        'name' => 'Robas',
        'index_title' => 'Robas List',
        'new_title' => 'New Roba',
        'create_title' => 'Create Roba',
        'edit_title' => 'Edit Roba',
        'show_title' => 'Show Roba',
        'inputs' => [
            'naziv' => 'Naziv',
            'sifra' => 'Sifra',
            'opis' => 'Opis',
            'kolicina' => 'Kolicina',
            'lokacija' => 'Lokacija',
        ],
    ],

    'zaposlenis' => [
        'name' => 'Zaposlenis',
        'index_title' => 'Zaposlenis List',
        'new_title' => 'New Zaposleni',
        'create_title' => 'Create Zaposleni',
        'edit_title' => 'Edit Zaposleni',
        'show_title' => 'Show Zaposleni',
        'inputs' => [
            'ime' => 'Ime',
            'username' => 'Username',
            'password' => 'Password',
        ],
    ],

    'izvestajs' => [
        'name' => 'Izvestajs',
        'index_title' => 'Izvestajs List',
        'new_title' => 'New Izvestaj',
        'create_title' => 'Create Izvestaj',
        'edit_title' => 'Edit Izvestaj',
        'show_title' => 'Show Izvestaj',
        'inputs' => [
            'zaposleni_id' => 'Zaposleni',
            'opis' => 'Opis',
            'datum' => 'Datum',
            'tip' => 'Tip',
        ],
    ],

    'transakcijas' => [
        'name' => 'Transakcijas',
        'index_title' => 'Transakcijas List',
        'new_title' => 'New Transakcija',
        'create_title' => 'Create Transakcija',
        'edit_title' => 'Edit Transakcija',
        'show_title' => 'Show Transakcija',
        'inputs' => [
            'zaposleni_id' => 'Zaposleni',
            'roba_id' => 'Roba',
            'kolicina' => 'Kolicina',
            'datum' => 'Datum',
            'tip' => 'Tip',
        ],
    ],
];
