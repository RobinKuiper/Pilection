<?php

Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push('Home', '/');
});

Breadcrumbs::register('login', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Login', route('sessions.create'));
});

Breadcrumbs::register('register', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Register', route('users.create'));
});

Breadcrumbs::register('items', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('type', route('items.index'));
});

Breadcrumbs::register('item', function($breadcrumbs, $item) {
    $breadcrumbs->parent('items');

    $breadcrumbs->push($item->title, route('items.show', $item->id));
});