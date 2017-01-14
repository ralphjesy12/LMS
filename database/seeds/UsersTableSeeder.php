<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use App\User;

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $faker = Faker::create();

        Permission::truncate();
        Role::truncate();
        User::truncate();

        \DB::table('role_user')->delete();
        \DB::table('permission_role')->delete();


        // CREATE USERS
        $admin = User::create([
            'name' => $faker->name,
            'email' => 'admin@lms.com',
            'password' => bcrypt('admin123$$'),
        ]);

        $student = User::create([
            'name' => $faker->name,
            'email' => 'student@lms.com',
            'password' => bcrypt('student123$$'),
        ]);

        $teacher = User::create([
            'name' => $faker->name,
            'email' => 'teacher@lms.com',
            'password' => bcrypt('teacher123$$'),
        ]);

        $principal = User::create([
            'name' => $faker->name,
            'email' => 'principal@lms.com',
            'password' => bcrypt('principal123$$'),
        ]);

        $parent = User::create([
            'name' => $faker->name,
            'email' => 'parent@lms.com',
            'password' => bcrypt('parent123$$'),
        ]);

        //CREATE ROLES
        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'The man who cant be moved',
        ]);

        $studentRole = Role::create([
            'name' => 'student',
            'display_name' => 'Student',
            'description' => 'The one who studies the lessons',
        ]);

        $teacherRole = Role::create([
            'name' => 'teacher',
            'display_name' => 'Teacher',
            'description' => 'The one who creates the lessons',
        ]);

        $parentRole = Role::create([
            'name' => 'parent',
            'display_name' => 'Parent',
            'description' => 'The one who observes the students',
        ]);

        $principalRole = Role::create([
            'name' => 'principal',
            'display_name' => 'Principal',
            'description' => 'The one who moderates the teachers',
        ]);

        // CREATE PERMISSIONS
        $manage_users = Permission::create([
            'name' => 'manage-all-permissions',
            'display_name' => 'Manage Users,Roles and Permissions',
            'description' => 'Can manage users,roles and permission"s',
        ]);

        // ATTACH EVERYTHING
        $adminRole->attachPermission($manage_users);

        $admin->attachRole($adminRole);
        $student->attachRole($studentRole);
        $teacher->attachRole($teacherRole);
        $parent->attachRole($parentRole);
        $principal->attachRole($principalRole);

    }
}
