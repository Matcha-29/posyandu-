@extends('layouts.app')

@section('title', 'Kelola Akun — POSYANDU')

@section('content')
    <!-- Topbar -->
    <div class="topbar flex items-center justify-between mb-8">
        <div class="topbar-title">
            <h1 class="text-[36px] font-extrabold text-pos-gray-900 leading-none">Kelola Akun</h1>
            <p class="mt-2 text-[14px] text-pos-gray-500 font-medium">Kelola akun petugas dan admin Posyandu Anda di sini.</p>
        </div>
        <div class="flex items-center gap-4">
            <button onclick="openModal()" class="bg-pos-green-mid hover:bg-pos-green-dark text-white px-5 py-3 rounded-pos-radius font-bold text-sm flex items-center gap-2 shadow-pos-shadow transition-all hover:-translate-y-[2px]">
                <i class="ti ti-plus text-base"></i> Tambah Akun
            </button>
            <div class="admin-badge flex items-center gap-3 bg-white border border-pos-gray-100 rounded-full px-4 py-2 shadow-pos-shadow">
                <img class="w-10 h-10 rounded-full object-cover border border-pos-green-light" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=80&h=80&q=80" alt="Admin" />
                <div class="text-left">
                    <p class="text-xs font-bold leading-none text-pos-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-[9px] font-bold text-pos-gray-500 uppercase tracking-widest mt-1">{{ Auth::user()->role }}</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-pos-radius flex items-center gap-3 animate-fade-up">
        <i class="ti ti-circle-check text-xl text-green-600"></i>
        <span class="text-sm font-bold">{{ session('success') }}</span>
    </div>
    @endif

    <div class="pos-table-card">
        <table class="pos-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td class="!font-bold !text-pos-gray-900">{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <span class="px-3 py-1.5 rounded-full text-[10px] font-extrabold uppercase {{ $u->role == 'admin' ? 'bg-[#eef2f0] text-pos-gray-900' : 'bg-pos-green-pale text-pos-green-dark' }}">
                            {{ $u->role }}
                        </span>
                    </td>
                    <td>
                        <span class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full {{ $u->is_active ? 'bg-[#3dab6a]' : 'bg-[#ef4444]' }}"></span>
                            <span class="text-xs font-bold {{ $u->is_active ? 'text-[#1a5c38]' : 'text-[#ef4444]' }}">
                                {{ $u->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </span>
                    </td>
                    <td onclick="event.stopPropagation()">
                        <div class="flex justify-end gap-3">
                            <button onclick="editUser({{ $u->id }})" class="p-2 text-pos-green-mid hover:bg-pos-green-pale rounded-lg transition-colors" title="Edit">
                                <i class="ti ti-edit text-lg"></i>
                            </button>
                            @if($u->id !== Auth::id())
                            <form action="/data_akun/{{ $u->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-[#ef4444] hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <i class="ti ti-trash text-lg"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Form -->
    <div id="modalUser" class="hidden fixed inset-0 bg-black/60 z-[200] items-center justify-center backdrop-blur-sm p-4">
        <div class="bg-white rounded-pos-radius w-full max-w-md overflow-hidden shadow-pos-shadow-lg animate-[fade-up_0.3s_ease]">
            <div class="bg-pos-green-dark p-6 text-white flex justify-between items-center border-b border-white/10">
                <h3 class="font-extrabold text-lg flex items-center gap-2" id="modalTitle">
                    <i class="ti ti-user-plus"></i> Tambah Akun
                </h3>
                <button onclick="closeModal()" class="text-2xl leading-none hover:opacity-75 transition-opacity">&times;</button>
            </div>
            <form id="userForm" action="/data_akun" method="POST" class="p-6 space-y-5">
                @csrf
                <div id="methodField"></div>
                <div>
                    <label class="block text-[11px] font-extrabold text-pos-gray-900 mb-1.5 uppercase tracking-wider">Nama Lengkap</label>
                    <input type="text" name="name" id="fName" required class="w-full px-4 py-3 border border-pos-gray-100 rounded-pos-radius text-sm focus:border-pos-green-mid outline-none bg-pos-gray-50 focus:bg-white transition-all" />
                </div>
                <div>
                    <label class="block text-[11px] font-extrabold text-pos-gray-900 mb-1.5 uppercase tracking-wider">Email</label>
                    <input type="email" name="email" id="fEmail" required class="w-full px-4 py-3 border border-pos-gray-100 rounded-pos-radius text-sm focus:border-pos-green-mid outline-none bg-pos-gray-50 focus:bg-white transition-all" />
                </div>
                <div>
                    <label class="block text-[11px] font-extrabold text-pos-gray-900 mb-1.5 uppercase tracking-wider">Role</label>
                    <select name="role" id="fRole" class="w-full px-4 py-3 border border-pos-gray-100 rounded-pos-radius text-sm focus:border-pos-green-mid outline-none bg-pos-gray-50 focus:bg-white transition-all">
                        <option value="petugas">Petugas</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div id="passwordArea">
                    <label class="block text-[11px] font-extrabold text-pos-gray-900 mb-1.5 uppercase tracking-wider">Password</label>
                    <input type="password" name="password" id="fPassword" class="w-full px-4 py-3 border border-pos-gray-100 rounded-pos-radius text-sm focus:border-pos-green-mid outline-none bg-pos-gray-50 focus:bg-white transition-all" placeholder="Minimal 6 karakter" />
                </div>
                <div>
                    <label class="block text-[11px] font-extrabold text-pos-gray-900 mb-1.5 uppercase tracking-wider">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="fPasswordConf" class="w-full px-4 py-3 border border-pos-gray-100 rounded-pos-radius text-sm focus:border-pos-green-mid outline-none bg-pos-gray-50 focus:bg-white transition-all" />
                </div>
                <div class="flex items-center gap-2.5 py-1.5">
                    <input type="checkbox" name="is_active" id="fActive" value="1" checked class="w-4.5 h-4.5 text-pos-green-mid border-pos-gray-100 rounded focus:ring-pos-green-light" />
                    <label for="fActive" class="text-xs font-bold text-pos-gray-900 uppercase tracking-wider">Akun Aktif</label>
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="closeModal()" class="flex-1 px-6 py-3 border border-pos-gray-100 text-pos-gray-500 font-bold rounded-pos-radius hover:bg-pos-gray-50 transition-all">Batal</button>
                    <button type="submit" class="flex-1 px-6 py-3 bg-pos-green-dark text-white font-bold rounded-pos-radius hover:bg-pos-green-mid transition-all shadow-pos-shadow">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const users = @json($users);

        function openModal() {
            document.getElementById('modalTitle').innerHTML = '<i class="ti ti-user-plus"></i> Tambah Akun';
            document.getElementById('userForm').action = '/data_akun';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('fName').value = '';
            document.getElementById('fEmail').value = '';
            document.getElementById('fRole').value = 'petugas';
            document.getElementById('fActive').checked = true;
            document.getElementById('fPassword').required = true;
            document.getElementById('fPassword').placeholder = 'Minimal 6 karakter';
            document.getElementById('modalUser').classList.remove('hidden');
            document.getElementById('modalUser').classList.add('flex');
        }

        function editUser(id) {
            const u = users.find(x => x.id === id);
            if (!u) return;

            document.getElementById('modalTitle').innerHTML = '<i class="ti ti-edit"></i> Edit Akun';
            document.getElementById('userForm').action = '/data_akun/' + id;
            document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('fName').value = u.name;
            document.getElementById('fEmail').value = u.email;
            document.getElementById('fRole').value = u.role;
            document.getElementById('fActive').checked = u.is_active;
            document.getElementById('fPassword').required = false;
            document.getElementById('fPassword').placeholder = 'Kosongkan jika tidak ingin ganti';
            
            document.getElementById('modalUser').classList.remove('hidden');
            document.getElementById('modalUser').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('modalUser').classList.add('hidden');
            document.getElementById('modalUser').classList.remove('flex');
        }
    </script>
@endsection
