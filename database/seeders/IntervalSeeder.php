<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IntervalSeeder extends Seeder
{
    /**
     * Количество интервалов для создания
     */
    const INTERVALS_COUNT = 10000;

    /**
     * Минимальное значение для start
     */
    const MIN_START = 0;

    /**
     * Максимальное значение для start
     */
    const MAX_START = 99;

    /**
     * Максимальное значение для end
     */
    const MAX_END = 100;

    /**
     * Вероятность NULL для end (в процентах)
     */
    const NULL_END_PROBABILITY = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $intervals = [];

        for ($i = 0; $i < self::INTERVALS_COUNT; $i++) {
            $start = rand(self::MIN_START, self::MAX_START);

            // Генерируем случайный end, который больше или равен start и не превышает MAX_END
            // или NULL с заданной вероятностью
            $setNull = (rand(self::MIN_START + 1, self::MAX_END) <= self::NULL_END_PROBABILITY);

            $end = $setNull ? null : rand($start, self::MAX_END);

            $intervals[] = [
                'start' => $start,
                'end' => $end,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Вставляем все записи одним запросом для повышения производительности
        DB::table('intervals')->insert($intervals);
    }
}
