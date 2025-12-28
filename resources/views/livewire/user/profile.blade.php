<div class="w-full px-4 md:px-10 py-10 bg-white">
    <div class="max-w-4xl mx-auto space-y-10">

        <section>
            <h2 class="text-xl font-bold uppercase tracking-tight mb-6 text-black">PROFILE</h2>
            <div class="bg-white rounded-sm p-6 md:p-10 shadow-lg">
                <div class="space-y-8">
                    <div class="flex flex-col">
                        <label class="text-[10px] font-bold uppercase tracking-widest mb-2">NAMA</label>
                        <div class="flex items-center justify-between border-b border-gray-700 pb-2">
                            <span class="text-[14px] font-medium uppercase">{{ $user->nama_lengkap }}</span>
                            <button wire:click="openEditNameModal" class="hover:scale-110 transition-transform">
                                <svg class="w-4 h-4 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Email</label>
                        <div class="pb-2">
                            <span class="text-[14px] font-medium">{{ $user->email }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <div class="flex justify-between items-center mb-4">
                            <label class="text-[10px] font-bold uppercase tracking-widest">Alamat</label>
                            <button wire:click="openAddAddressModal"
                                class="text-[10px] font-bold uppercase underline hover:text-gray-300 transition-colors">
                                @if ($user->alamat)
                                    Edit
                                @else
                                    + Tambah
                                @endif
                            </button>
                        </div>

                        @if ($user->alamat)
                            <div class="border border-gray-300 p-4 rounded-sm">
                                <p class="text-[14px] text-gray-700">{{ $user->alamat }}</p>
                            </div>
                        @else
                            <div
                                class="border border-dashed border-gray-600 py-6 rounded-sm flex items-center
                                    justify-center gap-3">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-[12px] text-gray-400">Tidak ada alamat yang ditambahkan.</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h2 class="text-xl font-bold uppercase tracking-tight mb-6 text-black">SETTINGS</h2>

            <div class="bg-white rounded-sm p-6 md:p-10 shadow-lg space-y-10">

                <div class="flex flex-col md:flex-row gap-6 items-center">
                    <div class="flex-1 flex items-center gap-3">
                        <x-lucide-lock-keyhole class="w-6 h-6" />
                        <div>
                            <h3 class="text-[13px] font-bold uppercase tracking-tight text-black">KELUAR DARI SEMUA
                                PERANGKAT</h3>
                            <p class="text-[11px] text-gray-400 leading-relaxed">Jika Anda kehilangan perangkat
                                atau memiliki kekhawatiran terkait keamanan, keluar dari semua akun Anda.</p>
                        </div>
                    </div>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class=" border border-gray-500 px-6 py-3 text-[11px] font-bold uppercase text-black hover:bg-black hover:text-white transition-all">
                            KELUAR
                        </button>
                    </form>
                </div>

                <div>
                    <hr class="border-t border-gray-200">
                </div>

                <div class="flex flex-col md:flex-row gap-6 items-center">
                    <div class="flex-1 flex items-center gap-3">
                        <x-lucide-key-round class="w-6 h-6" />
                        <div>
                            <h3 class="text-[13px] font-bold uppercase tracking-tight text-black">Ganti Password</h3>
                            <p class="text-[11px] text-gray-400 leading-relaxed">Perbarui kata sandi Anda
                                secara
                                berkala untuk menjaga keamanan akun Anda.</p>
                        </div>
                    </div>
                    <a href="{{ route('user.change-password') }}" wire:navigate
                        class=" border border-gray-500 px-6 py-3 text-[11px] font-bold uppercase text-black hover:bg-black hover:text-white transition-all">
                        Reset Password
                    </a>
                </div>



            </div>
        </section>

    </div>

    @if ($showEditNameModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold uppercase tracking-tight">Edit Nama</h3>
                    <button wire:click="closeEditNameModal" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="updateName">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" wire:model="nama_lengkap"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent"
                            placeholder="Masukkan nama lengkap">
                        @error('nama_lengkap')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex gap-3 justify-end">
                        <button type="button" wire:click="closeEditNameModal"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition-colors">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if ($showAddAddressModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold uppercase tracking-tight">{{ $user->alamat ? 'Edit' : 'Tambah' }}
                        Alamat</h3>
                    <button wire:click="closeAddAddressModal" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="updateAddress">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                        <textarea wire:model="alamat" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent"
                            placeholder="Masukkan alamat lengkap"></textarea>
                        @error('alamat')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex gap-3 justify-end">
                        <button type="button" wire:click="closeAddAddressModal"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition-colors">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
