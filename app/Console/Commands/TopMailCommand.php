<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TopMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Сбор каталога top.mail.ru';

    protected $topMailService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(\App\Services\TopMail\TopMailService $topMailService)
    {
        parent::__construct();

        $this->topMailService = $topMailService;
    }

    /**
     * Execute the console command.
     * @throws \Exception
     */
    public function handle()
    {
        for ($page = 20; $page <= 5000; $page++) {
            $url = 'https://top.mail.ru/Rating/All/Today/Visitors/'.$page.'.html';
            $this->info($url);
            try {
                $dto = $this->topMailService->getDtoByUrl($url);
                $this->topMailService->storeDto($dto);
            } catch (\Exception $e) {
                throw $e;
            }
        }
    }
}
