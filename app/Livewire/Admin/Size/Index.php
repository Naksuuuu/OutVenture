<?php

namespace App\Livewire\Admin\Size;

use App\Models\SizeGroup;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Index extends Component
{
    use WithPagination;

    #[Url(history: true, keep: true)]
    public $search = '';

    #[Url(history: true, keep: true)]
    public $sortBy = 'latest';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSortBy()
    {
        $this->resetPage();
    }

    public function render()
    {
        $sizeGroups = SizeGroup::query()
            ->when($this->search, function ($query) {
                $query->where('nama_group', 'like', '%' . $this->search . '%');
            })
            ->withCount(['values', 'categories'])
            ->when($this->sortBy === 'latest', function ($query) {
                $query->latest();
            })
            ->when($this->sortBy === 'oldest', function ($query) {
                $query->oldest();
            })
            ->paginate(10);

        return view('livewire.admin.size.index', ['sizeGroups' => $sizeGroups])
            ->layout('components.layouts.admin', ['title' => 'Size Management']);
    }
}
