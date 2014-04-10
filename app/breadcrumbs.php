<?php

Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push('Home', '/');
});

/*Breadcrumbs::register('about', function($breadcrumbs) {
    $breadcrumbs->push('About', 'about');
});*/

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

Breadcrumbs::register('scripts', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Scripts', route('scripts.index'));
});

Breadcrumbs::register('script', function($breadcrumbs, $script) {
    $breadcrumbs->parent('scripts');

    $breadcrumbs->push($script->title, route('scripts.show', $script->id));
});

Breadcrumbs::register('projects', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Projects', route('projects.index'));
});

Breadcrumbs::register('project', function($breadcrumbs, $project) {
    $breadcrumbs->parent('projects');

    $breadcrumbs->push($project->title, route('projects.show', $project->id));
});