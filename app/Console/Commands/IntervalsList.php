<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class IntervalsList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'intervals:list
                            {--left= : Левая граница интервала}
                            {--right= : Правая граница интервала}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Выводит список интервалов в заданных границах';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $left = $this->option('left');
        $right = $this->option('right');

        if ($left === null || $right === null) {
            $this->error('Необходимо указать обе опции --left и --right');
            return 1;
        }

        if (!is_numeric($left) || !is_numeric($right)) {
            $this->error('Значения --left и --right должны быть числами');
            return 1;
        }

        $left = (int) $left;
        $right = (int) $right;

        if ($left > $right) {
            $this->error('Значение --left должно быть меньше или равно --right');
            return 1;
        }

        $intervals = DB::table('intervals')
            ->where(function ($query) use ($left, $right) {
                // Интервал [a, b] пересекается с заданным [left, right], если:
                // (a <= right) И (b >= left ИЛИ b IS NULL)
                $query->where('start', '<=', $right)
                    ->where(function ($q) use ($left) {
                        $q->where('end', '>=', $left)
                            ->orWhereNull('end');
                    });
            })
            ->orderBy('start')
            ->get();

        if ($intervals->isEmpty()) {
            $this->info("Не найдено интервалов, пересекающихся с [{$left}, {$right}]");
            return 0;
        }

        $headers = ['ID', 'Start', 'End', 'Интерпретация'];
        $rows = [];

        foreach ($intervals as $interval) {
            $endDisplay = $interval->end === null ? 'NULL' : $interval->end;
            $interpretation = $interval->end === null
                ? "[{$interval->start}, +∞)"
                : "[{$interval->start}, {$interval->end}]";

            $rows[] = [
                $interval->id,
                $interval->start,
                $endDisplay,
                $interpretation
            ];
        }

        $this->table($headers, $rows);
        $this->info("Всего найдено: " . count($intervals) . " интервалов");

        return 0;
    }
}
