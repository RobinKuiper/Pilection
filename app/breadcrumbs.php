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

Breadcrumbs::register('users', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Users', route('users.index'));
});

Breadcrumbs::register('user', function($breadcrumbs, $user) {
    $breadcrumbs->parent('users');

    $breadcrumbs->push($user->username, route('users.show', $user->id));
});