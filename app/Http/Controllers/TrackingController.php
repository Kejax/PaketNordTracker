<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\ShipmentUpdate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TrackingController extends Controller
{
    function track(Request $request, $id) {

        $s = Shipment::where('id', $id)->with(['statuses' => function($query) {
            $query->orderBy('created_at', 'asc');
        }])->first();

        return view('welcome', [
            'shipment' => $s,
            'staff' => $request->has('staff')
        ]);

    }

    function update(Request $request, $id) {

        $s = Shipment::where('id', $id)->first();

        $u = ShipmentUpdate::create([
            'title' => $request->input('title'),
            'text' => $request->input('text')
        ]);

        $s->statuses()->save($u);

        return redirect(route('track', $id));

    }

    function create(Request $request) {

        if ($request->method() == 'POST') {

            $data = $request->validate([
                'sender_name' => ['required', 'string'],
                'sender_city' => ['required', 'string'],
                'sender_country' => ['required', 'string'],

                'receiver_name' => ['required', 'string'],
                'receiver_city' => ['required', 'string'],
                'receiver_country' => ['required', 'string'],
            ]);

            $s = Shipment::create($data);

            return redirect(route('track', $s->id));

        } else {
            return view('create', ['staff' => $request->has('staff')]);
        }

    }

    function deliver(Request $request, $id) {

        $data = $request->validate([
            'location' => ['required', Rule::in(['resident', 'mailbox', 'postoffice', 'packstation'])]
        ]);

        error_log('test');

        $table = [
            'resident' => 'Die Sendung wurde einem Hausbewohner übergeben',
            'mailbox' => 'Die Sendung wurde im Briefkasten abgelegt',
            'postoffice' => 'Die Sendung wurde in der Postfiliale abgeholt',
            'packstation' => 'Die Sendung wurde aus der Packstation abgeholt'
        ];

        $d = ShipmentUpdate::create([
            'title' => 'Zugestellt',
            'text' => $table[$data['location']]
        ]);

        $s = Shipment::where('id', $id)->first();

        $s->statuses()->save($d);

        $s->delivered = true;
        $s->save();

        return redirect(route('track', $s->id));
    }
}
