<?php

Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push('Home', route('systems.index'));
});

Breadcrumbs::register('about', function($breadcrumbs) {
    $breadcrumbs->push('About', route('about'));
});

Breadcrumbs::register('login', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Login', route('sessions.create'));
});

Breadcrumbs::register('register', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Register', route('users.create'));
});

Breadcrumbs::register('systems', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Systems', route('systems.index'));
});

Breadcrumbs::register('system', function($breadcrumbs, $system) {
    $breadcrumbs->parent('systems');

    $breadcrumbs->push($system->title, route('systems.show', $system->id));
});