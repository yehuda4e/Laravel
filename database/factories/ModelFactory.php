<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->UserName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
		'ip'        => $faker->ipv4,
		'group_id'    => 2,
		'location'  => $faker->country,        
        'remember_token' => str_random(10),
    ];
});

// Categories
$factory->define(App\Category::class, function() {
    return [
        'name'  => 'News'
    ];
});

// Articles
$factory->define(App\Article::class, function() {
    return [
        'subject'     => 'welcome',
        'category_id'  => 2,
        'slug'      => 'welcome',
        'content'   => 'This is new site. Welcome.',
        'user_id'   => 1
    ];
});

// Groups
$factory->define(App\Group::class, function() {
    return [
        'name'          => 'Admins',
        'color'         => 'blue',
        'permissions'   => '{"admin":1,"topic":{"create":1}}'
    ];
});


// Forum Categories
$factory->define(App\ForumCategory::class, function (Faker\Generator $faker) {
    return [
        'name'  => $faker->name,
    ];
});

// Forums
$factory->define(App\Forum::class, function (Faker\Generator $faker) {
    return [
        'name'  => $faker->name,
		'description'   => $faker->realText(),
        'category'	    => rand(1,3),
    ];
});

// Topics
$factory->define(App\Topic::class, function (Faker\Generator $faker) {
	return [
		'subject'	=> $faker->name,
        'forum_id'	=> rand(1,10),
        'user_id'		=> rand(1,50),
        'content'	=> $faker->realText(),
	];
});

// Comments
$factory->define(App\Comment::class, function (Faker\Generator $faker) {
	return [
		'commentable_id'	=> rand(1,50),
		'commentable_type'	=> 'App\Topic',
        'user_id'	=> rand(1,50),
        'body'	=> $faker->realText(),
	];
});
