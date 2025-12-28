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
                            <button class="hover:scale-110 transition-transform">
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
                            <button
                                class="text-[10px] font-bold uppercase underline hover:text-gray-300 transition-colors">+
                                Tambah</button>
                        </div>

                        <div
                            class="border border-dashed border-gray-600 py-6 rounded-sm flex items-center
                                justify-center gap-3">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-[12px] text-gray-400">Tidak ada alamat yang ditambahkan.</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h2 class="text-xl font-bold uppercase tracking-tight mb-6 text-black">SETTINGS</h2>

            <div class="bg-white rounded-sm p-6 md:p-10 shadow-lg space-y-10">

                <div class="flex flex-col md:flex-row md:items-start gap-6">
                    <div class="md:w-1/3 flex items-start gap-3">
                        <svg class="w-5 h-5 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <div>
                            <h3 class="text-[13px] font-bold uppercase tracking-tight text-black">KELUAR DARI SEMUA
                                PERANGKAT</h3>
                            <p class="text-[11px] text-gray-400 mt-2 leading-relaxed">Jika Anda kehilangan perangkat
                                atau memiliki kekhawatiran terkait keamanan, keluar dari semua akun Anda.</p>
                        </div>
                    </div>
                    <div
                        class="md:w-2/3 flex items-center justify-between border border-gray-200 p-6 rounded-md bg-white">
                        <button
                            class="border border-gray-500 px-6 py-3 text-[11px] font-bold uppercase text-black hover:bg-black hover:text-white transition-all">
                            KELUAR
                        </button>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row md:items-start gap-6 pt-10 border-t border-gray-200">
                    <div class="md:w-1/3 flex items-start gap-3">
                        <svg class="w-5 h-5 mt-0.5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                        <div>
                            <h3 class="text-[13px] font-bold uppercase tracking-tight text-black">PASSWORD</h3>
                            <p class="text-[11px] text-gray-400 mt-2 leading-relaxed">Perbarui kata sandi Anda
                                secara
                                berkala untuk menjaga keamanan akun Anda.</p>
                        </div>
                    </div>
                    <div
                        class="md:w-2/3 flex items-center justify-between border border-gray-200 p-6 rounded-md bg-white">
                        <a href={{ route('user.change-password') }} wire:navigate
                            class="border border-gray-500 px-6 py-3 text-[11px] font-bold uppercase text-black hover:bg-black hover:text-white transition-all">
                            Reset Password
                        </a>
                    </div>
                </div>

            </div>
        </section>

    </div>
</div>
