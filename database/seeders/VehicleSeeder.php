<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $now = Carbon::now();

        $vehicles = [
                    // Cars
                    ['brand' => 'Toyota', 'model' => 'Vitz', 'reference' => 'rent', 'vehicle_type' => 'car', 'body_type' => 'hatchback', 'seats' => 5, 'doors' => 5],
                    ['brand' => 'Honda', 'model' => 'Fit', 'reference' => 'rent', 'vehicle_type' => 'car', 'body_type' => 'hatchback', 'seats' => 5, 'doors' => 5],
                    ['brand' => 'Toyota', 'model' => 'C-HR', 'reference' => 'rent', 'vehicle_type' => 'car', 'body_type' => 'SUV', 'seats' => 5, 'doors' => 5],
                    ['brand' => 'Toyota', 'model' => 'RAV4', 'reference' => 'rent', 'vehicle_type' => 'car', 'body_type' => 'SUV', 'seats' => 5, 'doors' => 5],
                    ['brand' => 'Toyota', 'model' => 'Corolla Cross', 'reference' => 'rent', 'vehicle_type' => 'car', 'body_type' => 'SUV', 'seats' => 5, 'doors' => 5],
                    ['brand' => 'Toyota', 'model' => 'Touring', 'reference' => 'rent', 'vehicle_type' => 'car', 'body_type' => 'wagon', 'seats' => 5, 'doors' => 5],
                    ['brand' => 'Suzuki', 'model' => 'Alto', 'reference' => 'rent', 'vehicle_type' => 'car', 'body_type' => 'compact', 'seats' => 4, 'doors' => 5],

                    // Scooters
                    ['brand' => 'Yamaha', 'model' => 'NMax Scooter', 'reference' => 'rent', 'vehicle_type' => 'scooter', 'body_type' => 'step-through', 'seats' => 2, 'doors' => 0],
                    ['brand' => 'Honda', 'model' => 'Dio Scooter', 'reference' => 'rent', 'vehicle_type' => 'scooter', 'body_type' => 'step-through', 'seats' => 2, 'doors' => 0],
                    ['brand' => 'Kymco', 'model' => 'Agility Scooter', 'reference' => 'rent', 'vehicle_type' => 'scooter', 'body_type' => 'step-through', 'seats' => 2, 'doors' => 0],

                    // Bikes
                    ['brand' => 'Honda', 'model' => 'CB125E', 'reference' => 'sale', 'vehicle_type' => 'bike', 'body_type' => 'naked', 'seats' => 2, 'doors' => 0],
                    ['brand' => 'Honda', 'model' => 'CB125F', 'reference' => 'sale', 'vehicle_type' => 'bike', 'body_type' => 'naked', 'seats' => 2, 'doors' => 0],
                    ['brand' => 'Yamaha', 'model' => 'R1', 'reference' => 'sale', 'vehicle_type' => 'bike', 'body_type' => 'sport', 'seats' => 2, 'doors' => 0],
                    ['brand' => 'Yamaha', 'model' => 'R7', 'reference' => 'sale', 'vehicle_type' => 'bike', 'body_type' => 'sport', 'seats' => 2, 'doors' => 0],
                    ['brand' => 'Yamaha', 'model' => 'R15', 'reference' => 'sale', 'vehicle_type' => 'bike', 'body_type' => 'sport', 'seats' => 2, 'doors' => 0],
                    ['brand' => 'Yamaha', 'model' => 'Delight', 'reference' => 'sale', 'vehicle_type' => 'scooter', 'body_type' => 'step-through', 'seats' => 2, 'doors' => 0],
                    ['brand' => 'Kawasaki', 'model' => 'Ninja 400', 'reference' => 'sale', 'vehicle_type' => 'bike', 'body_type' => 'sport', 'seats' => 2, 'doors' => 0],
                    ['brand' => 'KTM', 'model' => 'Duke 200', 'reference' => 'sale', 'vehicle_type' => 'bike', 'body_type' => 'naked', 'seats' => 2, 'doors' => 0],
                    ['brand' => 'KTM', 'model' => 'RC 390', 'reference' => 'sale', 'vehicle_type' => 'bike', 'body_type' => 'sport', 'seats' => 2, 'doors' => 0],
                    ['brand' => 'Yamaha', 'model' => 'VStar 650cc', 'reference' => 'sale', 'vehicle_type' => 'bike', 'body_type' => 'cruiser', 'seats' => 2, 'doors' => 0],
                    ['brand' => 'Yamaha', 'model' => 'MT-07', 'reference' => 'sale', 'vehicle_type' => 'bike', 'body_type' => 'naked', 'seats' => 2, 'doors' => 0],

                    // E-Bikes
                    ['brand' => 'Milano', 'model' => 'Plus E-Bike', 'reference' => 'sale', 'vehicle_type' => 'ebike', 'body_type' => 'city', 'seats' => 1, 'doors' => 0],
                    ['brand' => 'VNIX', 'model' => 'E-Bike', 'reference' => 'sale', 'vehicle_type' => 'ebike', 'body_type' => 'mountain', 'seats' => 1, 'doors' => 0],
                ];

        foreach ($vehicles as $index => $v) {
            DB::table('vehicles')->insert([
                'brand' => $v['brand'],
                'model' => $v['model'],
                'year' => 2022 + ($index % 3),
                'registration_number' => strtoupper(substr($v['brand'], 0, 3)) . rand(100, 999),
                'vin' => 'VIN' . str_pad($index + 1, 7, '0', STR_PAD_LEFT),
                'colour' => ['Red', 'Blue', 'Black', 'White', 'Grey'][rand(0, 4)],
                'seats' => $v['seats'],
                'doors' => $v['doors'],

                'weekly' => rand(100, 800),
                'transmission' => ['Automatic', 'Manual'][rand(0, 1)],
                'fuel' => ['Petrol', 'Electric'][rand(0, 1)],
                'vehicle_type' => $v['vehicle_type'],
                'body_type' => $v['body_type'],
                'engine_no' => 'ENG' . rand(10000, 99999),
                'series' => strtoupper(substr($v['model'], 0, 3)) . rand(100, 999),
                'reference' => $v['reference'],
                'tracker' => false,
                'tracker_details' => null,
                'bond' => rand(200, 1000),
                'thumbnail' => 'https://media.whichcar.com.au/uploads/2023/08/94669057-2023-toyota-rav4-gxl-hybrid-srawlings-230724-28.jpg',
                'terms' => json_encode(['No smoking', 'Full tank on return']),
                'images' => json_encode([
                    'https://media.whichcar.com.au/uploads/2023/08/94669057-2023-toyota-rav4-gxl-hybrid-srawlings-230724-28.jpg',
                    'https://media.whichcar.com.au/uploads/2023/08/94669057-2023-toyota-rav4-gxl-hybrid-srawlings-230724-28.jpg'
                ]),
                'status' => 'available',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
