<div style="padding: clamp(15px, 3vw, 25px); max-width: 1400px; margin: 0 auto;">
    <div style="margin-bottom: clamp(15px, 5vw, 35px); border-bottom: 2px solid #f0f0f0; padding-bottom: clamp(15px, 4vw, 25px); display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: clamp(10px, 3vw, 20px);">
        
        <div style="flex: 1; min-width: 280px;">
            <h2 style="font-weight: 800; text-transform: uppercase; margin: 0; letter-spacing: 1px; color: #1a202c; font-size: clamp(1.5rem, 4vw, 2rem);">Admin Users</h2>
            <p style="color: #718096; margin: 4px 0 0 0; font-size: 0.85rem;">Kelola dan atur identitas administrator Anda</p>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: clamp(8px, 2vw, 12px); align-items: center; width: 100%; max-width: fit-content;">
            
            <div style="position: relative; flex: 1; min-width: 140px;">
                <select 
                    wire:model.live="roleFilter"
                    style="width: 100%; appearance: none; background: #fff; border: 1px solid #edf2f7; padding: 12px 35px 12px 15px; border-radius: 12px; font-size: 0.85rem; font-weight: 700; color: #1a202c; text-transform: uppercase; outline: none; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.02);"
                >
                    <option value="">SEMUA ROLE</option>
                    <option value="admin">ADMIN</option>
                    <option value="user">USER</option>
                </select>
                <div style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #a0aec0; font-size: 10px;">▼</div>
            </div>

            <div style="position: relative; flex: 1.5; min-width: 220px;">
                <span style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #a0aec0; display: flex; align-items: center;">
                    <x-lucide-search class="w-4 h-4" />
                </span>
                <input 
                    type="text" 
                    wire:model.live="search" 
                    placeholder="Cari User" 
                    style="width: 100%; padding: 12px 15px 12px 45px; border-radius: 12px; border: 1px solid #edf2f7; background: #fff; font-size: 0.9rem; outline: none; box-shadow: 0 2px 4px rgba(0,0,0,0.02); box-sizing: border-box;"
                >
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(min(100%, 350px), 1fr)); gap: clamp(12px, 3vw, 20px);">
        @forelse ($admins as $admin)
            <div style="background: #fff; border-radius: 20px; padding: clamp(15px, 4vw, 25px); box-shadow: 0 4px 20px rgba(0,0,0,0.04); border: 1px solid #f1f1f1; display: flex; align-items: center; justify-content: space-between; transition: 0.2s;">
                
                <div style="flex-grow: 1; min-width: 0; padding-right: 10px;">
                    <h4 style="margin: 0; font-size: 1.1rem; font-weight: 800; color: #1a202c; text-transform: uppercase; letter-spacing: 0.5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $admin->name ?? 'USER NAME' }}
                    </h4>
                    <p style="margin: 3px 0; color: #718096; font-size: 0.85rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $admin->email }}</p>
                    <div style="margin-top: 8px;">
                        <span style="background: #1a202c; color: white; padding: 4px 12px; border-radius: 6px; font-size: 0.65rem; font-weight: 800; text-transform: uppercase;">
                            {{ $admin->role }}
                        </span>
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 8px; flex-shrink: 0;">
                    <a href="/dashboard/users/{{ $admin->id }}/show" wire:navigate title="Detail" style="text-decoration: none; background: #f8fafc; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; border-radius: 10px; border: 1px solid #edf2f7; color: #1a202c;">
                        <x-lucide-eye class="w-4 h-4" />
                    </a>
                    <a href="/dashboard/users/{{ $admin->id }}/edit" wire:navigate title="Edit" style="text-decoration: none; background: #f8fafc; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; border-radius: 10px; border: 1px solid #edf2f7; color: #1a202c;">
                        <x-lucide-square-pen class="w-4 h-4 text-blue-500" />
                    </a>
                </div>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; background: #fdfdfd; border-radius: 20px; border: 2px dashed #eee;">
                <p style="color: #a0aec0; font-weight: 600;">Data tidak ditemukan.</p>
            </div>
        @endforelse
    </div>
</div>