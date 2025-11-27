<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        
        foreach ($users as $user) {
            // Welcome notification
            Notification::createForUser(
                $user->id,
                'Selamat Datang di E-Mading',
                'Terima kasih telah bergabung dengan sistem E-Mading SMK. Mulai berbagi artikel dan informasi sekolah!',
                'success'
            );
            
            // Info notification
            Notification::createForUser(
                $user->id,
                'Tips Menulis Artikel',
                'Gunakan gambar yang menarik dan tulis konten yang informatif untuk mendapat lebih banyak like!',
                'info'
            );
        }
    }
}