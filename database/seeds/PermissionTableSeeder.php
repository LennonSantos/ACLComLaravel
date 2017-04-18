<?php

use Illuminate\Database\Seeder;

use App\Permission;


class PermissionTableSeeder extends Seeder

{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run()

    {

        $permission = [

        	[
                'id' => 1,
        		'name' => 'role-list',

        		'display_name' => 'Tela que lista funções',

        		'description' => 'Apenas vizualiza a lista de funções'

        	],

        	[
                'id' => 2,
        		'name' => 'role-create',

        		'display_name' => 'Cria função',

        		'description' => 'Cria uma nova função'

        	],

        	[
                'id' => 3,
        		'name' => 'role-edit',

        		'display_name' => 'Edita função',

        		'description' => 'Edita função'

        	],

        	[
                'id' => 4,
        		'name' => 'role-delete',

        		'display_name' => 'Deleta Função',

        		'description' => 'Deleta Função'

        	],
            [
                'id' => 5,
                'name' => 'bloco-list',

                'display_name' => 'Tela que lista blocos',

                'description' => 'Apenas vizualiza a lista de bloco'

            ],

            [
                'id' => 6,
                'name' => 'bloco-create',

                'display_name' => 'Cria bloco',

                'description' => 'Cria novo bloco'

            ],

            [
                'id' => 7,
                'name' => 'bloco-edit',

                'display_name' => 'Edita bloco',

                'description' => 'Edita bloco'

            ],

            [
                'id' => 8,
                'name' => 'bloco-delete',

                'display_name' => 'Deleta bloco',

                'description' => 'Deleta bloco'

            ]

        ];


        foreach ($permission as $key => $value) {

        	Permission::create($value);

        }

    }

}