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

Breadcrumbs::register('items', function($breadcrumbs, $type) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($type, route('items.index'));
});

Breadcrumbs::register('item', function($breadcrumbs, $item, $type) {
    $breadcrumbs->parent('items', $type);

    $breadcrumbs->push($item->title, route('items.show', $item->id));
});

Breadcrumbs::register('tags', function($breadcrumbs, $tag) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Tag: '.$tag, route('tags.index'));
});