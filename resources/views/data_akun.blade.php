<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelola Akun — POSYANDU</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: {
                        'pos-teal': '#0E766D',
                        'pos-teal-dark': '#0a5c55',
                        'pos-bg': '#f5f7f6',
                        'pos-border': '#e0ebe9',
                        'pos-text': '#1a1a1a',
                        'pos-navy': '#1e2a6e',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-pos-bg text-pos-text min-h-screen flex flex-col font-sans">
    <header class="w-full h-[70px] bg-pos-teal flex items-center justify-between px-10 shadow-md shrink-0">
      <div class="flex items-center gap-3">
        <a href="/list_data_pasien" class="text-white/80 hover:text-white transition-colors">
          <i class="ti ti-arrow-left text-2xl"></i>
        </a>
        <span class="text-white font-bold text-xl tracking-tight">Kelola Akun Petugas</span>
      </div>
      <div class="flex items-center gap-6">
        <button onclick="openModal()" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg font-bold text-sm flex items-center gap-2 transition-all">
          <i class="ti ti-plus"></i> Tambah Akun
        </button>
        <div class="text-white text-right">
          <p class="text-sm font-bold leading-none">{{ Auth::user()->name }}</p>
          <p class="text-[0.7rem] opacity-80 uppercase tracking-widest mt-1">{{ Auth::user()->role }}</p>
        </div>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-all" title="Logout">
            <i class="ti ti-logout text-lg"></i>
          </button>
        </form>
      </div>
    </header>

    <main class="flex-1 px-10 py-9 max-w-[1200px] w-full mx-auto">
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl flex items-center gap-3">
            <i class="ti ti-circle-check text-xl"></i>
            <span class="text-sm font-bold">{{ session('success') }}</span>
        </div>
        @endif

        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-pos-border">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-pos-border">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-pos-teal-dark uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-xs font-bold text-pos-teal-dark uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-xs font-bold text-pos-teal-dark uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-xs font-bold text-pos-teal-dark uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-pos-teal-dark uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-pos-border">
                    @foreach($users as $u)
                    <tr class="hover:bg-pos-teal-light transition-colors">
                        <td class="px-6 py-4 text-sm font-bold text-pos-text">{{ $u->name }}</td>
                        <td class="px-6 py-4 text-sm text-pos-muted">{{ $u->email }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-md text-[10px] font-extrabold uppercase {{ $u->role == 'admin' ? 'bg-pos-navy text-white' : 'bg-pos-teal/10 text-pos-teal' }}">
                                {{ $u->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full {{ $u->is_active ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                <span class="text-xs font-bold {{ $u->is_active ? 'text-green-700' : 'text-red-700' }}">
                                    {{ $u->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button onclick="editUser({{ $u->id }})" class="p-2 text-pos-navy hover:bg-pos-navy/5 rounded-lg transition-colors" title="Edit">
                                    <i class="ti ti-edit text-lg"></i>
                                </button>
                                @if($u->id !== Auth::id())
                                <form action="/data_akun/{{ $u->id }}" method="POST" onsubmit="return confirm('Hapus akun ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
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
    </main>

    <!-- Modal Form -->
    <div id="modalUser" class="hidden fixed inset-0 bg-black/50 z-[100] items-center justify-center backdrop-blur-sm p-4">
        <div class="bg-white rounded-2xl w-full max-w-md overflow-hidden shadow-2xl animate-[slideUp_0.3s_ease]">
            <div class="bg-pos-navy p-6 text-white flex justify-between items-center">
                <h3 class="font-extrabold text-lg" id="modalTitle">Tambah Akun</h3>
                <button onclick="closeModal()" class="text-2xl leading-none">&times;</button>
            </div>
            <form id="userForm" action="/data_akun" method="POST" class="p-6 space-y-4">
                @csrf
                <div id="methodField"></div>
                <div>
                    <label class="block text-xs font-bold text-pos-navy mb-1.5 uppercase tracking-wider">Nama Lengkap</label>
                    <input type="text" name="name" id="fName" required class="w-full px-4 py-2.5 border border-pos-border rounded-lg text-sm focus:border-pos-teal outline-none" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-pos-navy mb-1.5 uppercase tracking-wider">Email</label>
                    <input type="email" name="email" id="fEmail" required class="w-full px-4 py-2.5 border border-pos-border rounded-lg text-sm focus:border-pos-teal outline-none" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-pos-navy mb-1.5 uppercase tracking-wider">Role</label>
                    <select name="role" id="fRole" class="w-full px-4 py-2.5 border border-pos-border rounded-lg text-sm focus:border-pos-teal outline-none">
                        <option value="petugas">Petugas</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div id="passwordArea">
                    <label class="block text-xs font-bold text-pos-navy mb-1.5 uppercase tracking-wider">Password</label>
                    <input type="password" name="password" id="fPassword" class="w-full px-4 py-2.5 border border-pos-border rounded-lg text-sm focus:border-pos-teal outline-none" placeholder="Minimal 6 karakter" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-pos-navy mb-1.5 uppercase tracking-wider">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="fPasswordConf" class="w-full px-4 py-2.5 border border-pos-border rounded-lg text-sm focus:border-pos-teal outline-none" />
                </div>
                <div class="flex items-center gap-2 py-2">
                    <input type="checkbox" name="is_active" id="fActive" value="1" checked class="w-4 h-4 text-pos-teal border-pos-border rounded" />
                    <label for="fActive" class="text-xs font-bold text-pos-navy uppercase tracking-wider">Akun Aktif</label>
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="closeModal()" class="flex-1 px-6 py-2.5 border border-pos-border text-pos-muted font-bold rounded-lg hover:bg-gray-50 transition-all">Batal</button>
                    <button type="submit" class="flex-1 px-6 py-2.5 bg-pos-teal text-white font-bold rounded-lg hover:bg-pos-teal-dark transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const users = @json($users);

        function openModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Akun';
            document.getElementById('userForm').action = '/data_akun';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('fName').value = '';
            document.getElementById('fEmail').value = '';
            document.getElementById('fRole').value = 'petugas';
            document.getElementById('fActive').checked = true;
            document.getElementById('fPassword').required = true;
            document.getElementById('modalUser').classList.remove('hidden');
            document.getElementById('modalUser').classList.add('flex');
        }

        function editUser(id) {
            const u = users.find(x => x.id === id);
            if (!u) return;

            document.getElementById('modalTitle').textContent = 'Edit Akun';
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
</body>
</html>