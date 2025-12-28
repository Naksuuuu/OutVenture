<div
    style="padding: clamp(15px, 5vw, 50px); display: flex; justify-content: center; align-items: center; background: #fcfcfc; min-height: 100vh; font-family: sans-serif;">
    <div
        style="background: #fff; width: 100%; max-width: 480px; border-radius: 24px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); padding: clamp(25px, 8vw, 40px); border: 1px solid #f1f1f1; box-sizing: border-box;">

        <div style="text-align: center; margin-bottom: clamp(25px, 7vw, 35px);">
            <h2
                style="font-weight: 900; text-transform: uppercase; margin: 0; color: #1a202c; letter-spacing: 0.5px; font-size: clamp(1.2rem, 5vw, 1.5rem);">
                Update Access</h2>
            <p style="color: #718096; font-size: clamp(0.75rem, 2.5vw, 0.85rem); margin-top: 5px;">Hanya hak akses yang
                dapat diperbarui</p>
        </div>

        <div
            style="margin-bottom: 25px; padding: clamp(15px, 5vw, 20px); background: #f8fafc; border-radius: 15px; border: 1px solid #e2e8f0;">
            <small
                style="display: block; color: #a0aec0; font-weight: 800; font-size: 0.65rem; text-transform: uppercase; margin-bottom: 5px; letter-spacing: 0.5px;">User
                Account</small>
            <div style="font-weight: 700; color: #1a202c; font-size: clamp(0.9rem, 3vw, 1rem); word-break: break-all;">
                {{ $admin->email ?? 'admin@outventure.com' }}
            </div>
        </div>

        <div style="margin-bottom: clamp(30px, 8vw, 40px);">
            <label
                style="display: block; font-weight: 800; margin-bottom: 12px; font-size: 0.75rem; color: #1a202c; text-transform: uppercase; letter-spacing: 0.5px;">Pilih
                Role Baru</label>
            <div style="position: relative;">
                <select wire:model="role"
                    style="width: 100%; padding: 16px; border-radius: 14px; border: 2px solid #1a202c; background: #fff; font-weight: 800; cursor: pointer; outline: none; appearance: none; font-size: 1rem; color: #1a202c; text-transform: uppercase;">
                    <option value="admin">ADMIN</option>
                    <option value="user">USER</option>
                </select>
                <div
                    style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #1a202c; font-size: 12px;">
                    ▼</div>
            </div>
        </div>

        <div style="display: flex; gap: 12px; align-items: center;">
            <button wire:click="update"
                style="flex: 2; background: #1a202c; color: white; border: none; padding: clamp(14px, 4vw, 18px); border-radius: 14px; font-weight: 800; cursor: pointer; text-transform: uppercase; font-size: clamp(0.8rem, 3vw, 1rem); transition: 0.3s;">
                Simpan
            </button>
            <a href="/dashboard/users" wire:navigate
                style="flex: 1; text-decoration: none; background: #f1f5f9; color: #4a5568; padding: clamp(14px, 4vw, 18px); border-radius: 14px; font-weight: 800; text-align: center; font-size: clamp(0.8rem, 2.5vw, 0.9rem); transition: 0.3s;">
                Batal
            </a>
        </div>
    </div>
</div>
