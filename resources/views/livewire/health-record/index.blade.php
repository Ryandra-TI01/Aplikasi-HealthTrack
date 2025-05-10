<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Catatan Kesehatan</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($healthTypes as $type)
            <a href="{{ route('health-record.by-type', $type->id) }}">
                <div class="bg-white rounded-2xl shadow p-6 hover:bg-blue-50 transition">
                    <h2 class="text-lg font-semibold">{{ $type->name }}</h2>
                    <p class="text-gray-500 mt-1">Klik untuk lihat data pencatatan</p>
                </div>
            </a>
        @endforeach
    </div>
    
</div>
