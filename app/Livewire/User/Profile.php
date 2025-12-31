<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{

  public $user = '';
  public $showEditNameModal = false;
  public $showAddAddressModal = false;
  public $nama_lengkap = '';
  public $alamat = '';

  /**
   * Menyiapkan data profil pengguna saat komponen dimuat.
   */
  public function mount()
  {
    $this->user = Auth::user();
    $this->nama_lengkap = $this->user->nama_lengkap;
    $this->alamat = $this->user->alamat ?? '';
  }

  /**
   * Membuka modal untuk mengedit nama lengkap.
   */
  public function openEditNameModal()
  {
    $this->nama_lengkap = $this->user->nama_lengkap;
    $this->showEditNameModal = true;
  }

  /**
   * Menutup modal edit nama lengkap dan mereset validasi.
   */
  public function closeEditNameModal()
  {
    $this->showEditNameModal = false;
    $this->resetValidation();
  }

  /**
   * Memperbarui nama lengkap pengguna.
   */
  public function updateName()
  {
    $this->validate([
      'nama_lengkap' => 'required|string|max:255',
    ], [
      'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
      'nama_lengkap.max' => 'Nama lengkap maksimal 255 karakter.',
    ]);

    $user = Auth::user();
    $user->nama_lengkap = $this->nama_lengkap;
    $user->save();

    $this->user = $user;
    $this->showEditNameModal = false;

    $this->dispatch('notify', type: 'success', message: 'Nama berhasil diperbarui.');
  }

  /**
   * Membuka modal untuk menambah atau mengedit alamat.
   */
  public function openAddAddressModal()
  {
    $this->alamat = $this->user->alamat ?? '';
    $this->showAddAddressModal = true;
  }

  /**
   * Menutup modal alamat dan mereset validasi.
   */
  public function closeAddAddressModal()
  {
    $this->showAddAddressModal = false;
    $this->resetValidation();
  }

  /**
   * Memperbarui alamat pengguna.
   */
  public function updateAddress()
  {
    $this->validate([
      'alamat' => 'required|string|max:500',
    ], [
      'alamat.required' => 'Alamat wajib diisi.',
      'alamat.max' => 'Alamat maksimal 500 karakter.',
    ]);

    $user = Auth::user();
    $user->alamat = $this->alamat;
    $user->save();

    $this->user = $user;
    $this->showAddAddressModal = false;

    $this->dispatch('notify', type: 'success', message: 'Alamat berhasil diperbarui.');
  }

  /**
   * Merender tampilan halaman profil pengguna.
   */
  public function render()
  {

    $this->user = Auth::user();

    return view('livewire.user.profile')
      ->layout('components.layouts.app', ['title' => 'Profile']);
  }
}
