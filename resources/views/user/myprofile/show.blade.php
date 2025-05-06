<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-semibold text-center mb-6">My Profile</h1>
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <div class="text-xl font-medium text-gray-700 mb-4">
                Informasi Akun User
            </div>
            <div class="space-y-4">
                <p><span class="font-bold">Name:</span> {{ $user->name }}</p>
                <p><span class="font-bold">Email:</span> {{ $user->email }}</p>
                <p><span class="font-bold">Dibuat :</span> {{ $user->created_at->format('d M Y') }}</p>
                <!-- Kamu bisa menambahkan field lain jika ada -->
            </div>
        </div>
    </div>
</x-app-layout>