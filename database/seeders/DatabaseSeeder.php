<?php

namespace Database\Seeders;

use App\Models\Shipment;
use App\Models\ShipmentUpdate;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       $s = Shipment::create([
            'sender_name' => 'Kejax',
            'sender_city' => 'MineTown',
            'sender_country' => 'DE',

            'receiver_name' => 'Snowyyy',
            'receiver_city' => 'MineTown',
            'receiver_country' => 'DE',
       ]);

       $u = ShipmentUpdate::create([
            'title' => 'Die Sendungsinformationen erhalten',
            'text' => 'Die Sendung wurde elektronisch angekündigt und wir erwarten die Übergabe.',
       ]);

       $s->statuses()->save($u);

       $u = ShipmentUpdate::create([
            'title' => 'Wir haben die Sendung erhalten',
            'text' => 'Die Sendung wurde vom Absender an uns übergeben',
       ]);

       $s->statuses()->save($u);

       $u = ShipmentUpdate::create([
            'title' => 'Paket wurde eingeliefert',
            'text' => 'Die Sendung wurde im Paketzentrum registriert',
       ]);

       $s->statuses()->save($u);

       $u = ShipmentUpdate::create([
            'title' => 'Paket wurde eingeliefert',
            'text' => 'Die Sendung wurde im Paketzentrum registriert',
       ]);

       $s->statuses()->save($u);

       $u = ShipmentUpdate::create([
            'title' => 'Paket wurde eingeliefert',
            'text' => 'Die Sendung wurde im Paketzentrum registriert',
       ]);

       $s->statuses()->save($u);

       $u = ShipmentUpdate::create([
            'title' => 'Paket wurde eingeliefert',
            'text' => 'Die Sendung wurde im Paketzentrum registriert',
       ]);

       $s->statuses()->save($u);

       $u = ShipmentUpdate::create([
            'title' => 'Paket wurde eingeliefert',
            'text' => 'Die Sendung wurde im Paketzentrum registriert',
       ]);

       $s->statuses()->save($u);

       $u = ShipmentUpdate::create([
            'title' => 'Paket wurde eingeliefert',
            'text' => 'Die Sendung wurde im Paketzentrum registriert',
       ]);

       $s->statuses()->save($u);

       $u = ShipmentUpdate::create([
            'title' => 'Paket wurde eingeliefert',
            'text' => 'Die Sendung wurde im Paketzentrum registriert',
       ]);

       $s->statuses()->save($u);

       error_log($s->id);

    }
}
