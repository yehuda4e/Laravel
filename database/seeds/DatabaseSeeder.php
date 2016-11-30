<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * This tables will truncate each time seed make.
	 * 
	 * @var array
	 */
	protected $truncate = ['users', 'groups', 'categories', 'articles', 'forum_categories', 'forums', 'topics', 'comments'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // 
        foreach ($this->truncate as $table)	{
        	\DB::table($table)->truncate();
        }

        // Users
        factory(App\User::class)->create([
            'username'  => 'yehuda4e',
            'email'     => 'yehuda4e@gmail.com',
            'password'  => Hash::make(123456),
            'ip'        => '192.0.0.1',
            'group_id'    => 1,
            'location'  => 'localhost',
            'remember_token' => str_random(10),            
        ]);

        factory(App\User::class, 49)->create();

        // Categories
       // factory(App\Category::class)->create();

        factory(App\Category::class)->create([
            'name'  => 'Test'
        ]);

        // Articles
        factory(App\Article::class)->create();

        // Groups
        factory(App\Group::class)->create([
            'name'          => 'Admins',
            'color'         => 'Blue',
            'permissions'   => '{"admin":1,"topic":{"create":1}}'
        ]);

        factory(App\Group::class)->create([
            'name'          => 'Users',
            'color'         => 'black',
            'permissions'   => '{"admin":0,"topic":{"create":1}}'
        ]);

        factory(App\Group::class)->create([
            'name'          => 'Guests',
            'color'         => 'gray',
            'permissions'   => '{"admin":0,"topic":{"create":1}}'
        ]);      
      

        factory(App\Category::class, 1)->create();
        factory(App\ForumCategory::class, 3)->create();
        factory(App\Forum::class, 10)->create();
        factory(App\Topic::class, 50)->create();
        factory(App\Comment::class, 100)->create();        
    }
}
