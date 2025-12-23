<?php

namespace App\Livewire\Public;

use Livewire\Component;

class Home extends Component
{

  public $brands = [
    ['name' => 'THE NORTH FACE', 'image' => 'images/thenorthface.jpg'],
    ['name' => 'EIGER', 'image' => 'images/taseiger.jpg'],
    ['name' => 'CONSINA', 'image' => 'images/sepatuconsina.jpg'],
    ['name' => 'CONSINA', 'image' => 'images/sepatuconsina.jpg'],
  ];

  public $categories = [
    ['name' => 'TENDA', 'image' => 'images/tenda.jpg'],
    ['name' => 'SEPATU', 'image' => 'images/sepatuhiking.jpg'],
    ['name' => 'MATRAS', 'image' => 'images/matras.jpg'],
    ['name' => 'TAS', 'image' => 'images/tas.jpg'],
    ['name' => 'JAKET', 'image' => 'images/gorpcore.jpg'],
    ['name' => 'TOPI', 'image' => 'images/topi.jpg'],
    ['name' => 'KOMPOR', 'image' => 'images/kompor.jpg'],
    ['name' => 'KURSI LIPAT', 'image' => 'images/kursilipat.jpg'],
    ['name' => 'SLEEPING BAG', 'image' => 'images/sleepingbag.jpg'],
    ['name' => 'MEJA LIPAT', 'image' => 'images/mejalipat.jpg'],
  ];

  public function render()
  {
    return view('livewire.public.home')
      ->layout('components.layouts.app', ['title' => 'Outventure - Home']);
  }
}
