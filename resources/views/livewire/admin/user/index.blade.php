<div>
    @forelse ($admins as $admin)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <h3>{{ $admin->name }}</h3>
            <p>Email: {{ $admin->email }}</p>
            <p>Role: {{ $admin->role }}</p>
        </div>
    @empty
        <p>Tidak ada admin ditemukan.</p>
    @endforelse
</div>
