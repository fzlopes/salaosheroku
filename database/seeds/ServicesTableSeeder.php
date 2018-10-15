<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::truncate();

        Service::create([
            'name' => 'Feminino'
        ]);

        Service::create([
            'name' => 'Feminino e Tintura'
        ]);

        Service::create([
            'name' => 'Tintura(com tinta)'
        ]);

        Service::create([
            'name' => 'Tintura(sem tinta)'
        ]);

        Service::create([
            'name' => 'Masculino Máquina'
        ]);

        Service::create([
            'name' => 'Masculino Tesoura'
        ]);

        Service::create([
            'name' => 'Pé'
        ]);

        Service::create([
            'name' => 'Mão'
        ]);

        Service::create([
            'name' => 'Mão e Pé'
        ]);

        Service::create([
            'name' => 'Luzes'
        ]);

        Service::create([
            'name' => 'Progressiva'
        ]);

        Service::create([
            'name' => 'Escova'
        ]);

        Service::create([
            'name' => 'Mega Hair'
        ]);

        Service::create([
            'name' => 'Chapinha'
        ]);

        $this->command->info('The basic services was created.');
    }
}
