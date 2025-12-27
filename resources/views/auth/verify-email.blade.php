<div style="text-align: center; margin-top: 50px;">
    <h1>Verifikasi Email Anda</h1>
    <p>Kami sudah mengirimkan link verifikasi ke email anda.</p>
    <p>Belum menerima email?</p>
    <form action="{{ route('verification.send') }}" method="post">
        @csrf
        <button type="submit">Kirim Ulang Email Verifikasi</button>
    </form>
</div>
