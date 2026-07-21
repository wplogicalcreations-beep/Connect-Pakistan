<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\VarDumper;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('modules')->truncate();
        DB::table('permissions')->truncate();
        $modules = config('modules-permission');
        return $this->_seedTables($modules);
    }

    private function _seedTables($modules)
    {
        $status = '';
        foreach ($modules as $name => $module) {
            $created_module = $this->_createModule($name);
            VarDumper::dump('Module ' . $created_module->name . ' has been created');
            if ($this->_isArrayHasModules($module)) {
                $status = $this->_arrayOfModules($module, $created_module);
            } else {
                $module_permissions = [];
                if (is_array($module)) {
                    foreach ($module as $value => $module_permission) {
                        $module_permissions[] = [
                            'name' => $module_permission,
                            'module_id' => $created_module->id,
                            'guard_name' => 'web',
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                        VarDumper::dump('Permission ' . $module_permission . ' has been created with module name ' . $created_module->name);
                    }
                    $status = $this->_createPermission($module_permissions);
                } else {
                    $module_permissions = [
                        'name' => $name,
                        'module_id' => $created_module->id,
                        'guard_name' => 'web',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                    VarDumper::dump('Permission ' . $name . ' has been created with module name ' . $created_module->name);
                    $status = $this->_createPermission($module_permissions);
                }
            }
        }
        return $status;
    }

    private function _arrayOfModules($module, $created_module)
    {
        $status = "";
        foreach ($module as $key => $permission) {
            if (!(is_array($permission))) {
                $status = Permission::findOrCreate($permission, 'web', $created_module->id);
            } else {
                $created_sub_module = $this->_createModule($key, $created_module->id);
                VarDumper::dump('Sub Module ' . $created_sub_module->name . ' has been created');
                if ($this->_isArrayHasModules($permission)) {
                    $status = $this->_arrayOfModules($permission, $created_sub_module);
                } else {
                    $sub_module_permissions = [];
                    foreach ($permission as $value => $module_permission) {
                        $sub_module_permissions[] = [
                            'name' => $module_permission,
                            'module_id' => $created_sub_module->id,
                            'guard_name' => 'web',
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                        VarDumper::dump('Permission ' . $value . ' has been created with module name ' . $created_sub_module->name);
                    }
                    $status = $this->_createPermission($sub_module_permissions);
                }
            }
        }
        return $status;
    }

    /**
     * @param $name
     * @param $parent_id
     * @return mixed
     */
    private function _createModule($name, $parent_id = null)
    {
        $array = [
            'name' => $name,
            'parent_id' => $parent_id
        ];
        return Module::create($array);
    }

    /**
     * @param $perissions
     * @return mixed
     */
    private function _createPermission($perissions)
    {
        return Permission::insert($perissions);
    }

    private function _isArrayHasModules($array)
    {
        if (is_array($array)) {
            foreach ($array as $value) {
                if (is_array($value))
                    return true;
            }
            return false;
        }
    }
}
