@extends('user.dashboard')

@section('content')
<div class="p-8 flex justify-center items-start min-h-screen">
    <div class="w-full max-w-2xl">
        
        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-xs font-bold text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-2xl text-xs">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white/5 border border-white/10 rounded-[2.5rem] p-8 md:p-12 shadow-2xl backdrop-blur-sm">
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                            class="w-full bg-white border-2 border-gray-100 rounded-2xl px-6 py-4 text-gray-900 focus:border-red-600 focus:ring-0 transition-all font-bold shadow-sm" required>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                            class="w-full bg-white border-2 border-gray-100 rounded-2xl px-6 py-4 text-gray-900 focus:border-red-600 focus:ring-0 transition-all font-bold shadow-sm" required>
                    </div>
                    

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Password Baru</label>
                            <input type="password" name="new_password" placeholder="••••••••" 
                                class="w-full bg-white border-2 border-gray-100 rounded-2xl px-6 py-4 text-gray-900 focus:border-red-600 focus:ring-0 transition-all font-bold shadow-sm">
                        </div>
                        
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Konfirmasi</label>
                            <input type="password" name="new_password_confirmation" placeholder="••••••••" 
                                class="w-full bg-white border-2 border-gray-100 rounded-2xl px-6 py-4 text-gray-900 focus:border-red-600 focus:ring-0 transition-all font-bold shadow-sm">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full py-5 bg-red-600 text-white font-black uppercase text-xs tracking-[0.3em] rounded-2xl hover:bg-red-700 hover:shadow-red-600/40 transition-all shadow-xl shadow-red-600/20 mt-4">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection