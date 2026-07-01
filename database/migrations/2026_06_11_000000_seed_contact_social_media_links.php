<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up(): void
     {
         if (Schema::hasTable('dashboards')) {
             $settings = [
                 'kontak_facebook_link'  => 'https://www.facebook.com/PKTJTegal/',
                 'kontak_instagram_link' => 'https://www.instagram.com/pktj_tegal/',
                 'kontak_twitter_link'   => 'https://x.com/pktjtegal',
                 'kontak_youtube_link'   => 'https://www.youtube.com/channel/UC9BbdnU-cczfaZ5FHulYPZA',
                 'kontak_linktree_link'  => 'https://linktr.ee/pktj_tegal',
                 'kontak_whatsapp_link'  => 'https://api.whatsapp.com/send/?phone=6281234700230&text&type=phone_number&app_absent=0',
                 'kontak_tiktok_link'    => 'https://www.tiktok.com/@pktj_tegal',
                 'kontak_website_link'   => 'https://pktj.ac.id',
                 
                 // Also update the non-prefixed ones if they exist
                 'facebook_link'  => 'https://www.facebook.com/PKTJTegal/',
                 'instagram_link' => 'https://www.instagram.com/pktj_tegal/',
                 'twitter_link'   => 'https://x.com/pktjtegal',
                 'youtube_link'   => 'https://www.youtube.com/channel/UC9BbdnU-cczfaZ5FHulYPZA',
             ];

             foreach ($settings as $key => $value) {
                 $exists = DB::table('dashboards')->where('key', $key)->exists();
                 if ($exists) {
                     DB::table('dashboards')
                         ->where('key', $key)
                         ->update([
                             'value' => $value,
                             'updated_at' => now(),
                         ]);
                 } else {
                     DB::table('dashboards')->insert([
                         'key' => $key,
                         'value' => $value,
                         'type' => 'text',
                         'description' => 'Pengaturan link sosial media ' . $key,
                         'aktif' => true,
                         'created_at' => now(),
                         'updated_at' => now(),
                     ]);
                 }
             }
         }
     }

     /**
      * Reverse the migrations.
      */
     public function down(): void
     {
         // Keep them to prevent data loss
     }
};
