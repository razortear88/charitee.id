Repositori untuk aplikasi Charitee.id

List Route:
- ("/" = Homepage)
- ("/navbar" = Navbar) (ini cuma buat ngeliat tampilan navbar)
- ("/footer" = Navbar) (ini cuma buat ngeliat tampilan footer)
- ("/login" = Login Admin)
- ("/panti/[panti->slug]" = Detail panti)
- ("/list-panti" = List Panti)
- ("/donasi-uang/[donasi_uang->id_donasi]" = Detail Donasi Uang)
- ("/donasi-barang/[donasi_barang->id_donasi]" = Detail Donasi Barang)

URL Admin
- ("/admin/list-donasi-uang" = List Donasi Uang)
- ("/admin/donasi-uang/[donasi_uang->id_donasi]" = Edit Donasi Uang)
- ("/admin/list-donasi-barang" = List Donasi Barang)
- ("/admin/donasi-barang/[donasi_barang->id_donasi]" = Edit Donasi Barang)
- ("/admin/list-panti" = List Panti)
- ("/admin/panti/create" = Create Panti)
- ("/admin/panti/[panti->slug]/edit" = Edit Panti)
- ("/admin/kategori/create" = Create Kategori Kebutuhan)
- ("/admin/list-kategori" = List Kategori Kebutuhan)
- ("/admin/kategori/[kategori_kebutuhan->nama]/edit" = Edit Kategori Kebutuhan)