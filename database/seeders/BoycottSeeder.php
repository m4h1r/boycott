<?php

namespace Database\Seeders;

use App\Models\Boycott;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BoycottSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Boycott::insert([
            'brand_id' => 1,  
            'reason' => 'Son dönemde yaşanan olaylara karşı tepkilerini gizledikleri ve önemli ölçüde halkı desteklemedikleri için boykot başlatıldı.',
            'slug' => 'ulker-b',
            'start_date' => now(),
            'end_date' => now()->addMonths(1),  // Assuming a 6-month boycott
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Boycott::insert([
            'brand_id' => 8,  
            'reason' => 'Şirketin sahibi Abdülkadir Özkan, EspressoLab\'ı boykot ederek özgür haklarını kullanan kişilere vatan haini yakıştırmasında bulundu. Bu sebeple boykot başlatıldı.',
            'slug' => 'dbl-entertainment-vatan-hainligi-yaftasi',
            'start_date' => now(),
            'end_date' => now()->addMonths(1),  // Assuming a 6-month boycott
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Boycott::insert([
            'brand_id' => 9,  
            'reason' => 'Yaşanan otel yangınında sorumlulukların yerine getirilmesinde yaşanan şüpheli durumlardan boykot başlatılmıştır.',
            'slug' => 'dbl-entertainment-vatan-hainligi-yaftasi',
            'start_date' => now(),
            'end_date' => now()->addMonths(1),  // Assuming a 6-month boycott
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
