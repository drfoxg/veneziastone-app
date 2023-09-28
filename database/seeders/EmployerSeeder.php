<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $model = new Models\Employer();
        $table = $model->getTable();
        $tablePrefix = $model->getConnection()->getTablePrefix();

        \DB::statement("LOCK TABLES {$tablePrefix}{$table} WRITE;");
        \DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        \DB::statement("TRUNCATE {$tablePrefix}{$table};");
        \DB::statement("INSERT INTO {$tablePrefix}{$table} VALUES (1, 'Алеся', 26, 0, 2, 150000.00, 'РУБ', '2023-09-28 11:40:47', '2023-09-28 11:40:47'), (2, 'Илья', 52, 1, 0, 120000.00, 'РУБ', '2023-09-28 11:41:20', '2023-09-28 11:41:20'), (3, 'Сергей', 36, 1, 3, 130000.00, 'РУБ', '2023-09-28 11:52:12', '2023-09-28 11:52:12');");
        \DB::statement("SET FOREIGN_KEY_CHECKS=1;");
        \DB::statement("UNLOCK TABLES;");
    }
}
