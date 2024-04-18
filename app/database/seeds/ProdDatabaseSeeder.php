<?php

class ProdDatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();

        $this->call('EmptySeeder');
        $this->call('ProdUsersTableSeeder');
        $this->call('ProdCategoriesTableSeeder');
    }
}

class ProdUsersTableSeeder extends Seeder
{
    public function run() {
        $user = new User();
        $user->username = 'arju';
        $user->password = Hash::make('arju9531');
        $user->is_admin = true;
        $user->is_reporter = true;
        saveModel($user);

        $user = new User();
        $user->username = 'zuikyte';
        $user->password = Hash::make('mazyte');
        $user->is_admin = false;
        $user->is_reporter = true;
        saveModel($user);
    }
}

class ProdCategoriesTableSeeder extends Seeder
{
    public function run() {
        $cat = new Category();
        $cat->category_id = 'bd';
        $cat->name = 'Butas/Draudimas';
        $cat->name_short = 'Butas/Draud';
        $cat->order_pos = 1;
        $cat->descr = 'Butas, elektra, draudimai (buto, sveikatos, bedarbystes)';
        saveModel($cat);

        $cat = new Category();
        $cat->category_id = 'rm';
        $cat->name = 'Regularus Mokesciai';
        $cat->name_short = 'Reg.Mokesciai';
        $cat->order_pos = 2;
        $cat->descr = 'Mokykla, dagis, veckopeng, siggepeng, radiotjänst';
        saveModel($cat);

        $cat = new Category();
        $cat->category_id = 'ti';
        $cat->name = 'Telefonas/Internetas';
        $cat->name_short = 'Telef/Intern';
        $cat->order_pos = 3;
        $cat->descr = 'Telefono mokesciai, korteles papildymas';
        saveModel($cat);

        $cat = new Category();
        $cat->category_id = 'ma';
        $cat->name = 'Maistas';
        $cat->name_short = 'Maistas';
        $cat->order_pos = 4;
        $cat->descr = 'Maistas, restoranai';
        saveModel($cat);

        $cat = new Category();
        $cat->category_id = 'tr';
        $cat->name = 'Transportas';
        $cat->name_short = 'Transportas';
        $cat->order_pos = 5;
        $cat->descr = 'SL bilietai, taxi, keliones i LT';
        saveModel($cat);

        $cat = new Category();
        $cat->category_id = 'rb';
        $cat->name = 'Rubai';
        $cat->name_short = 'Rubai';
        $cat->order_pos = 6;
        $cat->descr = 'Rubai, batai';
        saveModel($cat);

        $cat = new Category();
        $cat->category_id = 'pr';
        $cat->name = 'Pramogos';
        $cat->name_short = 'Pramogos';
        $cat->order_pos = 7;
        $cat->descr = 'Kinas, koncertai, spektakliai, DVD, PS zaidimai, alkoholis';
        saveModel($cat);

        $cat = new Category();
        $cat->category_id = 'zd';
        $cat->name = 'Zaislai/Dovanos';
        $cat->name_short = 'Zaislai/Dovanos';
        $cat->order_pos = 7;
        $cat->descr = 'Zaislai vaikams, dovanos, lauktuves';
        saveModel($cat);

        $cat = new Category();
        $cat->category_id = 'be';
        $cat->name = 'Buitine Elektronika';
        $cat->name_short = 'Buit.Elektr';
        $cat->order_pos = 8;
        $cat->descr = 'Kompiuteriai, televizoriai, buitine technika';
        saveModel($cat);

        $cat = new Category();
        $cat->category_id = 'fv';
        $cat->name = 'Foto/Video';
        $cat->name_short = 'Foto/Video';
        $cat->order_pos = 8;
        $cat->descr = 'Foto/video iranga, programine iranga';
        saveModel($cat);

        $cat = new Category();
        $cat->category_id = 'iv';
        $cat->name = 'Ivairus';
        $cat->name_short = 'Ivairus';
        $cat->order_pos = 9;
        $cat->descr = 'Visa kita';
        saveModel($cat);
    }
}
