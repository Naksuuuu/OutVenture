<?php

namespace App\Livewire\Public;

use Livewire\Component;

class Home extends Component
{

  public $brands = [
    ['name' => 'THE NORTH FACE', 'image' => 'storage/thenorthface.jpg'],
    ['name' => 'EIGER', 'image' => 'storage/taseiger.jpg'],
    ['name' => 'CONSINA', 'image' => 'storage/sepatuconsina.jpg'],
    ['name' => 'CONSINA', 'image' => 'storage/sepatuconsina.jpg'],
  ];

  public $categories = [
    ['name' => 'TENDA', 'image' => 'storage/tenda.jpg'],
    ['name' => 'SEPATU', 'image' => 'storage/sepatuhiking.jpg'],
    ['name' => 'MATRAS', 'image' => 'storage/matras.jpg'],
    ['name' => 'TAS', 'image' => 'storage/tas.jpg'],
    ['name' => 'JAKET', 'image' => 'storage/gorpcore.jpg'],
    ['name' => 'TOPI', 'image' => 'storage/topi.jpg'],
    ['name' => 'KOMPOR', 'image' => 'storage/kompor.jpg'],
    ['name' => 'KURSI LIPAT', 'image' => 'storage/kursilipat.jpg'],
    ['name' => 'SLEEPING BAG', 'image' => 'storage/sleepingbag.jpg'],
    ['name' => 'MEJA LIPAT', 'image' => 'storage/mejalipat.jpg'],
  ];

  public function render()
  {
    return view('livewire.public.home')
      ->layout('components.layouts.app', ['title' => 'Outventure - Home']);
  }
}
