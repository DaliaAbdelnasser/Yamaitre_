<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // clear permission cache
         app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

         $collection = Route::getRoutes();
 
         $permissions = [];
 
         foreach ($collection as $route) {
             $routeName = $route->getName();
             $routePartials = explode('.', $routeName);
             if ($routeName && $routePartials[0] == 'admin' && !in_array($routeName, config('permission.excluded_routes'))) {
                 $page = $routePartials[1];
                 $action = $routePartials[2];
 
                 switch (true) {
                     case in_array($action, ['index', 'show']):
                         $permissions[$page . '_view'] = $page . ' view';
                         break;
 
                     case in_array($action, ['create', 'store']):
                         $permissions[$page . '_create'] = $page . ' create';
                         break;
 
                     case in_array($action, ['edit', 'update']):
                         $permissions[$page . '_edit'] = $page . ' edit';
                         break;
 
                     case in_array($action, ['destroy']):
                         $permissions[$page . '_delete'] = $page . ' delete';
                         break;
 
                     default:
                         $permissions[$page . '_' . $action] = $page . ' ' . $action;
                         break;
                 }
             }
         }
         // dd($permissions);
 
         foreach ($permissions as $permission) {
             Permission::findOrCreate($permission, 'admin');
         }
 
         // default roles
         Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
    }
}
