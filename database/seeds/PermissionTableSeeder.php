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

        		'name' => 'role-list',

        		'display_name' => 'Tela que lista funções',

        		'description' => 'Apenas vizualiza a lista de funções'

        	],

        	[

        		'name' => 'role-create',

        		'display_name' => 'Cria função',

        		'description' => 'Cria uma nova função'

        	],

        	[

        		'name' => 'role-edit',

        		'display_name' => 'Edita função',

        		'description' => 'Edita função'

        	],

        	[

        		'name' => 'role-delete',

        		'display_name' => 'Deleta Função',

        		'description' => 'Deleta Função'

        	],
            [

                'name' => 'bloco-list',

                'display_name' => 'Tela que lista blocos',

                'description' => 'Apenas vizualiza a lista de bloco'

            ],

            [

                'name' => 'bloco-create',

                'display_name' => 'Cria bloco',

                'description' => 'Cria novo bloco'

            ],

            [

                'name' => 'bloco-edit',

                'display_name' => 'Edita bloco',

                'description' => 'Edita bloco'

            ],

            [

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