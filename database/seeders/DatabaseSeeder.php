<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\categories;
use App\Models\jenis_program;
use App\Models\Profile;
use App\Models\program;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\gs;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
            'name' => 'Ahmad Yani',
            'username' => 'admin',
            'email' => 'ahmad.yani.ardath@gmail.com',
            'role' => 'admin',
            'is_active' => true,
            'password' => bcrypt('yaniardath!@#'),
        ]);

        Profile::create([
            'uid' => 1,
            'telegram' => null,
            'instagram' => null,
            'facebook' => null,
        ]);

        gs::create([
            'uid' => 1,
            'alamat' => 'Satreyan Maron',
            'jabatan' => 'Web Dev',
            'no_hp' => '081234567890',
            'bidang_studi' => '',
        ]);

        User::create([
            'name' => 'Najwan Nada',
            'username' => 'nada',
            'email' => 'najwannada@mazainulhasan1.sch.id',
            'role' => 'media',
            'is_active' => true,
            'password' => bcrypt('nada123'),
        ]);

        Profile::create([
            'uid' => 2,
            'telegram' => null,
            'instagram' => null,
            'facebook' => null,
        ]);

        User::create([
            'name' => 'Admin Madrasah',
            'username' => 'admin2',
            'email' => 'alexsaif@yahoo.com',
            'role' => 'media',
            'is_active' => true,
            'password' => bcrypt('admin2123'),
        ]);

        Profile::create([
            'uid' => 3,
            'telegram' => null,
            'instagram' => null,
            'facebook' => null,
        ]);

        User::create([
            'name' => 'Muhammad Hendra',
            'username' => 'mhd',
            'email' => 'hendra_elhaza@ymail.com',
            'role' => 'media',
            'is_active' => true,
            'password' => bcrypt('mhd123'),
        ]);

        Profile::create([
            'uid' => 4,
            'telegram' => null,
            'instagram' => null,
            'facebook' => null,
        ]);

        User::create([
            'name' => 'Rio Bahtiar',
            'username' => 'bahtiar',
            'email' => 'riobahtiar@live.com',
            'role' => 'media',
            'is_active' => true,
            'password' => bcrypt('bahtiar123'),
        ]);

        Profile::create([
            'uid' => 5,
            'telegram' => null,
            'instagram' => null,
            'facebook' => null,
        ]);

        categories::create([
            'nama' => 'Berita',
        ]);
        categories::create([
            'nama' => 'Informasi',
        ]);
        categories::create([
            'nama' => 'Prestasi',
        ]);

        $jenis_program = [
            [
                "nama" => "Intrakulikuler",
            ],
            [
                "nama" => "Ekstrakuikuler",
            ],
            [
                "nama" => "Program Unggulan",
            ]
        ];
        foreach ($jenis_program as $jp) {
            jenis_program::create([
                'nama' => $jp['nama']
            ]);
        }

        $program = [
            [
                'nama' => 'MIPA',
                'jenis' => 1,
            ],
            [
                'nama' => 'ISS',
                'jenis' => 1,
            ],
            [
                'nama' => 'PK',
                'jenis' => 1,
            ],
            [
                'nama' => 'Pramuka',
                'jenis' => 2,
            ],
            [
                'nama' => 'KIR',
                'jenis' => 2,
            ],
            [
                'nama' => 'Tartilul Qur\'an',
                'jenis' => 2,
            ],
            [
                'nama' => 'English Club',
                'jenis' => 2,
            ],
            [
                'nama' => 'Arabic Club',
                'jenis' => 2,
            ],
            [
                'nama' => 'Kelas Olimpiade',
                'jenis' => 2,
            ],
            [
                'nama' => 'Pagar Nusa',
                'jenis' => 2,
            ],
            [
                'nama' => 'Tahfidzul Qur\'an',
                'jenis' => 3,
            ],
            [
                'nama' => 'Tahqiqu Qiroatil Kutub',
                'jenis' => 3,
            ],
            [
                'nama' => 'Prodistik',
                'jenis' => 3,
            ],
        ];
        foreach ($program as $p) {
            program::create([
                'nama' => $p['nama'],
                'jenis_program_id' => $p['jenis'],
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac porta ipsum, rhoncus vestibulum nisl. Nulla sit amet nunc eget enim commodo aliquet sed ut erat. Quisque ligula dui, eleifend quis viverra et, feugiat eget ex. Proin convallis facilisis scelerisque. Donec vel purus varius ligula congue sollicitudin. Aliquam a pulvinar neque. Pellentesque vehicula aliquet enim, eget hendrerit erat interdum non. Vestibulum pharetra mauris in leo interdum, vestibulum hendrerit enim blandit. Sed cursus, mauris eget imperdiet facilisis, diam magna ullamcorper arcu, id blandit diam mi in tellus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis non dolor commodo, laoreet tortor id, sagittis tortor. Sed non dignissim lacus. Praesent ultrices leo felis, non tempus felis sagittis ac. Curabitur mollis, massa lobortis vehicula dictum, dui lectus posuere augue, nec venenatis magna magna a odio.

Etiam eget quam et nisl maximus sodales. Vivamus sem urna, semper sed viverra nec, malesuada quis tortor. Nunc scelerisque feugiat nisi a malesuada. Nunc dignissim turpis nisi, at tempor nisl suscipit a. Mauris ut nunc purus. Quisque rutrum vulputate purus, placerat dignissim dui consectetur at. Fusce sed rhoncus velit, non dapibus tortor. Donec a felis suscipit massa bibendum maximus. Pellentesque ornare fermentum lectus, quis gravida felis mollis id. Quisque ultrices, nisi et rutrum ultrices, mi ipsum varius felis, ut cursus tortor quam consequat neque. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec odio ante, hendrerit eu ornare vel, ornare sed magna. Etiam sollicitudin malesuada massa semper molestie. Vivamus porttitor nisl et lectus laoreet accumsan.

Vestibulum pulvinar dignissim risus, in posuere tellus interdum ut. Praesent sed pretium urna, a porta metus. In non pellentesque erat. Nulla et magna tincidunt, tempus elit non, viverra mi. Fusce congue massa eget sem elementum, eget iaculis lacus facilisis. Nullam ac efficitur leo, nec sagittis mauris. Etiam et enim sed ligula semper sagittis. Proin cursus vel ligula id semper. Quisque nec mi vel arcu ultrices egestas non nec est. Donec et justo mi. Sed in ante tellus. Sed eu orci tincidunt, viverra augue quis, euismod urna. In eget ante sapien. Sed scelerisque, turpis non ultrices bibendum, urna tellus luctus justo, at pellentesque odio enim sit amet metus.

Praesent eget mauris pulvinar, convallis tortor nec, rutrum nibh. Proin laoreet, purus a feugiat pretium, metus mi dignissim lectus, ac aliquam odio est in purus. Fusce feugiat rhoncus justo, non mattis nunc efficitur a. Vivamus in purus enim. Suspendisse a ipsum non urna fringilla eleifend sit amet non risus. Integer urna magna, pulvinar vel elit et, placerat rutrum eros. Integer ullamcorper orci ac cursus molestie. Vivamus porttitor maximus velit, eget pulvinar lectus pulvinar non. Curabitur augue leo, suscipit et sem a, consequat dapibus felis.

Proin scelerisque ornare justo, vulputate accumsan lacus. Nulla volutpat at neque a pellentesque. Mauris auctor lacus leo, quis consectetur ex porttitor vitae. Mauris nec imperdiet sapien, a interdum nunc. Nullam vel posuere nulla. Praesent ultrices, mi ut pellentesque auctor, libero leo scelerisque urna, in suscipit nunc orci nec nisl. Duis non congue erat, a varius tellus. Nullam varius purus vitae orci euismod, rutrum rhoncus ligula fermentum.'
            ]);
        }
    }
}
