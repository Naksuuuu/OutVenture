<div style="padding: clamp(15px, 5vw, 50px); display: flex; justify-content: center; background: #fcfcfc; min-height: 100vh; font-family: sans-serif;">
    <div style="background: #fff; width: 100%; max-width: 420px; border-radius: 24px; box-shadow: 0 20px 40px rgba(0,0,0,0.06); border: 1px solid #f0f0f0; overflow: hidden; height: fit-content;">
        
        <div style="background: #1a202c; padding: clamp(20px, 5vw, 40px); position: relative; display: flex; align-items: center; gap: 20px;">
            <div style="width: clamp(55px, 15vw, 75px); height: clamp(55px, 15vw, 75px); background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.2); flex-shrink: 0;">
                <span style="font-size: clamp(24px, 6vw, 32px); font-weight: 900; color: #1a202c;">
                    {{ strtoupper(substr($admin->name ?? 'A', 0, 1)) }}
                </span>
            </div>
            
            <div style="text-align: left;">
                <h3 style="margin: 0; font-weight: 900; text-transform: uppercase; color: #fff; letter-spacing: 1px; font-size: clamp(1rem, 4vw, 1.3rem); line-height: 1.2;">Detail User</h3>
                <p style="color: rgba(255,255,255,0.6); font-size: clamp(0.65rem, 2vw, 0.75rem); margin: 4px 0 0 0;">Data lengkap administrator</p>
            </div>
        </div>

        <div style="padding: clamp(25px, 8vw, 40px);">
            <div style="text-align: left;">
                <div style="margin-bottom: 25px; border-bottom: 1px solid #f8fafc; padding-bottom: 15px;">
                    <label style="display: block; color: #a0aec0; font-weight: 800; font-size: 0.65rem; text-transform: uppercase; margin-bottom: 5px; letter-spacing: 0.5px;">Nama Lengkap</label>
                    <div style="font-weight: 800; color: #1a202c; font-size: clamp(1rem, 3vw, 1.1rem); text-transform: uppercase;">{{ $admin->name ?? 'ADMIN' }}</div>
                </div>

                <div style="margin-bottom: 25px; border-bottom: 1px solid #f8fafc; padding-bottom: 15px;">
                    <label style="display: block; color: #a0aec0; font-weight: 800; font-size: 0.65rem; text-transform: uppercase; margin-bottom: 5px; letter-spacing: 0.5px;">Alamat Email</label>
                    <div style="font-weight: 700; color: #1a202c; font-size: clamp(0.9rem, 2.5vw, 1rem); word-break: break-all;">{{ $admin->email ?? 'admin@outventure.com' }}</div>
                </div>

                <div style="margin-bottom: clamp(30px, 8vw, 40px);">
                    <label style="display: block; color: #a0aec0; font-weight: 800; font-size: 0.65rem; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.5px;">Level Akses</label>
                    <div style="display: inline-block; background: #1a202c; color: white; padding: 6px 15px; border-radius: 8px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase;">
                        {{ $admin->role ?? 'ADMIN' }}
                    </div>
                </div>
            </div>

            <a href="/dashboard/users" wire:navigate style="display: flex; align-items: center; justify-content: center; gap: 10px; text-decoration: none; width: 100%; background: #f1f5f9; color: #64748b; padding: clamp(14px, 4vw, 18px); border-radius: 14px; font-weight: 800; text-transform: uppercase; font-size: clamp(0.8rem, 2.5vw, 0.9rem); transition: 0.3s;">
                <span style="font-size: 1.2rem;">&larr;</span>
                <span>Kembali ke Daftar</span>
            </a>
        </div>
    </div>
</div>