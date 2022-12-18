<?php

namespace App\Jobs;

use PhpIP\IPBlock;
use App\Models\Pool;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Log;

class GenerateIpJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Pool $pool;
    public int $count;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Pool $pool, $count = 0)
    {
        $this->pool = $pool;
        $this->count = $count;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // echo 'ok';
        //
        $pool = $this->pool;
        $count = $this->count;

        $position = $pool->position;


        $block = IPBlock::create($pool->pool);

        // get max ip
        $max = $block->getNbAddresses();

        // 检测当前的位置是否超过了最大值
        if ($position > $max) {
            // Log::error('当前的位置超过了最大值');
            return;
        }


        // 检测要生成的数量是否超过了剩余的数量
        if ($count > $max - $position) {
            // 生成剩余的数量
            $count = $max - $position;
        }


        // 生成ip
        for ($i = 0; $i < $count; $i++) {
            $ip = $block[$position];

            $create = [
                'ip' => $ip,
                'position' => $position,
                'price' => $pool->price,
            ];


            // log 当前 ip
            // Log::info('当前生成的 IP 为：' . $ip);


            // 如果是前 3 个 IP，就设置为不可用
            if ($position < 3) {
                $create['blocked'] = true;
            }

            // 如果是倒数后 3 个 IP，就设置为不可用
            if ($position > $max - 3) {
                $create['blocked'] = true;
            }

            $pool->ips()->create($create);

            $position++;
        }

        // 更新位置
        $pool->position = $position;
        $pool->save();

        return;
    }
}
