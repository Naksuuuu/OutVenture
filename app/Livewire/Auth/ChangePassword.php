<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{

    public $current_password, $new_password, $new_password_confirmation;

    public function updatePassword()
    {
        $this->validate([
            'current_password' => function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('Password lama salah!');
                }
            },
            'new_password' => 'required|min:8|confirmed|different:current_password',
        ], [
            'new_password.different' => 'Password baru tidak boleh sama dengan password lama.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
        ]);

        Auth::user()->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset();

        return redirect()->route('user.profile')->with('notifySuccess', 'Password berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.auth.change-password')->layout('components.layouts.auth', [
            'title' => 'Ganti Password'
        ]);
    }
}
