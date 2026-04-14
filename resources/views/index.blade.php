
<x-app-layout title="PaketNord Tracker">
    <div class="max-w-4xl mx-auto px-6 py-12">
        <!-- Tracking Input -->
        <div class="bg-white dark:bg-gray-800 dark:text-white rounded-2xl shadow-md p-8 mb-10">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Paket verfolgen</h2>
            <p class="text-gray-500 mb-6">Geben Sie Ihre Sendungsnummer ein, um den aktuellen Status zu sehen.</p>
            <div class="flex flex-col sm:flex-row gap-4">
                <input
                    id="trackingInput"
                    type="text"
                    placeholder="Sendungsnummer eingeben"
                    class="flex-grow rounded-lg border border-gray-600 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#08a2d7]"
                />
                <button onclick="track()" class="bg-[#08a2d7] text-white rounded-lg px-6 py-3 font-medium hover:opacity-70 transition cursor-pointer">
                Tracken
                </button>
                <script>
                    function track() {
                        document.location = '/track/' + document.getElementById('trackingInput').value;
                    }
                </script>
            </div>
        </div>


        <!-- Tracking Status -->
        @isset($shipment)
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-8 mb-10">

                <!-- Sendungsinformationen -->
                <div class="mb-8 grid grid-cols-1 sm:grid-cols-3 gap-6 border-b border-b-white pb-6">
                    <div>
                        <p class="text-sm text-gray-400">Sendungsnummer</p>
                        <p class="font-medium text-gray-900 dark:text-white"><span id="infoTracking">{{ $shipment->id }}</span></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Absender</p>
                        <p class="font-medium text-gray-900 dark:text-white"><span id="infoSender">{{ $shipment->sender_name }} ({{ $shipment->sender_city }}, {{ $shipment->sender_country }})</span></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Empfänger</p>
                        <p class="font-medium text-gray-900 dark:text-white"><span id="infoReceiver">{{ $shipment->receiver_name }} ({{ $shipment->receiver_city }}, {{ $shipment->receiver_country }})</span></p>
                    </div>
                </div>

                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Sendungsstatus</h3>


                <ol id="statusList" class="relative border-l border-gray-200 ml-4">
                    <!--<li class="mb-8 ml-6">
                        <span class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-[#152a51] dark:bg-[#08a2d7] rounded-full ring-8 ring-white"></span>
                        <h4 class="font-medium text-gray-900 dark:text-white">Paket wurde eingeliefert</h4>
                        <time class="text-sm text-gray-400">22.09.2025 – 09:14</time>
                        <p class="text-gray-500 mt-1">Sendung wurde im Paketzentrum registriert.</p>
                    </li>-->
                    @foreach($shipment->statuses as $status)
                        <li class="mb-8 ml-6">
                            <span class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-[#152a51] dark:bg-[#08a2d7] rounded-full ring-8 ring-white"></span>
                            <h4 class="font-medium text-gray-900 dark:text-white">{{ $status->title }}</h4>
                            <time class="text-sm text-gray-400">{{ $status->created_at }}</time>
                            <p class="text-gray-500 mt-1">{{ $status->text }}</p>
                        </li>
                    @endforeach

                    @if(!$shipment->delivered)
                        <li class="ml-6">
                            <span class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-gray-300 rounded-full ring-8 ring-white"></span>
                            <h4 class="font-medium text-gray-400">Zustellung</h4>
                            <p class="text-gray-400 mt-1">Noch nicht zugestellt</p>
                        </li>
                    @endif
                </ol>
            </div>


            @if($staff)
                <div class="mb-8 bg-white dark:bg-gray-800 rounded-2xl shadow-md p-8 dark:text-white">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Status ändern</h3>
                    <form class="flex flex-col" method="POST" action="/track/{{ $shipment->id }}/update">
                        @csrf
                        <input
                            name="title"
                            type="text"
                            placeholder="Titel"
                            class="mb-5 flex-grow rounded-lg border border-gray-600 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#08a2d7]"
                        />
                        <input
                            name="text"
                            type="text"
                            placeholder="Text"
                            class="mb-5 flex-grow rounded-lg border border-gray-600 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#08a2d7]"
                        />
                        <button onclick="track()" class="bg-[#08a2d7] text-white rounded-lg px-6 py-3 font-medium hover:opacity-70 transition cursor-pointer">
                            Status ändern
                        </button>
                    </form>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-8 dark:text-white">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Zustellung</h3>
                    <form class="flex flex-col" method="POST" action="/track/{{ $shipment->id }}/deliver">
                        @csrf
                        <span class="flex flex-row content-center">
                            <input id="resident" class="size-5 mr-2 mb-4" type="radio" name="location" value="resident" required checked>
                            <label for="resident">Hausbewohner übergeben</label>
                        </span>
                        <span class="flex flex-row content-center">
                            <input id="mailbox" class="size-5 mr-2 mb-4" type="radio" name="location" value="mailbox">
                            <label for="mailbox">In den Briefkasten gelegt</label>
                        </span>
                        <span class="flex flex-row content-center">
                            <input id="postoffice" class="size-5 mr-2 mb-4" type="radio" name="location" value="postoffice">
                            <label for="postoffice">In der Filiale abgegeben</label>
                        </span>
                        <span class="flex flex-row content-center">
                            <input id="packstation" class="size-5 mr-2" type="radio" name="location" value="packstation">
                            <label for="packstation">In der Packstation abgelegt</label>
                        </span>
                        <button onclick="track()" class="mt-5 bg-[#08a2d7] text-white rounded-lg px-6 py-3 font-medium hover:opacity-70 transition cursor-pointer">
                            Als zugestellt markieren
                        </button>
                    </form>
                </div>
            @endif

        @endisset

    </div>
</x-app-layout>