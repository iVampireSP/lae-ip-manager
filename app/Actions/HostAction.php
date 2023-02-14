<?php

namespace App\Actions;

use App\Models\Host;
use App\Models\Ip;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Exceptions\HostActionException;

/**
 * 这里是主机的操作，你可以在这里写任何你想要的操作。
 *
 * 我们推荐将它推到队列中执行，这样可以极大地提高性能。
 *
 * 但是需要结合你的业务来决定是否需要推到队列中执行，否则会在开发时造成不必要的麻烦。
 *
 */
class HostAction extends Action
{

    /**
     * @throws HostActionException
     */
    public function create(array $requests): Host
    {

        $pool_id = $requests['pool_id'];

        // 寻找可用的 IP
        $ip = (new Ip)->where('pool_id', $pool_id)
            ->whereNull('host_id')
            ->where('blocked', 0)
            ->with('pool')
            ->first();

        if (!$ip) {
            throw new HostActionException('没有可用的 IP 地址。');
        }

        $name = 'IP: ' . $ip->ip;

        $host = $this->createCloudHost($ip->pool->price ?? 0, [
            'name' => $name,
        ]);

        $host->name = $name;
        $host->price = $ip->pool->price ?? 0;
        $host->status = 'running';
        $host->user_id = auth('api')->id();

        $host->save();

        $ip->host_id = $host->id;
        $ip->save();

        $host->load('ip');
        $host->ip->load('pool');

        return $host;
    }

    public function update(Host $host, array $requests): Host
    {
        return $host;
    }

    /**
     * @throws HostActionException
     */
    public function destroy(Host $host): bool
    {
        // 你不应该删除 pending 状态的主机，因为它还没有创建成功。
        if ($host->status === 'pending') {
            throw new HostActionException('主机正在创建中，无法删除');
        }

        $host->load('ip');

        if ($host->ip->module_id) {
            try {
                $this->http->delete("/modules/{$host->ip->module_id}/ips/$host->host_id")->json();
            } catch (Exception $e) {
                Log::error($e->getMessage());
                throw new HostActionException('对端未能及时释放 IP 地址，无法删除。');
            }
        }

        // 解除 IP 绑定
        $host->ip->host_id = null;
        $host->ip->module_id = null;
        $host->ip->module_host_id = null;
        $host->ip->save();

        $host->delete();
        // 告诉云端，此主机已被删除。
        $this->deleteCloudHost($host);

        return true;
    }

    /**
     * 接下来，是主机的状态操作，比如重启、关机、开机等，或者 running, stopping, suspended 等状态执行的操作。
     * 目前支持的状态有: running, stopped, error, suspended, pending
     */
    public function running(Host $host)
    {
        // Log::info('正在开机...');
        // 启动此主机，比如启动虚拟机，启动数据库等等。
    }

    /**
     * @throws HostActionException
     */
    public function stopped(Host $host)
    {
        // 关闭此主机，比如关闭虚拟机，关闭数据库等等。
        $this->destroy($host);
    }

    /**
     * @throws HostActionException
     */
    public function suspended(Host $host)
    {
        $this->destroy($host);
    }

    // 这个状态一般不用操作。
    public function pending(Host $host)
    {
    }

    // 这个状态一般不用操作。因为这个状态多半是由于云端的问题导致的，或者云端无法请求您的模块时。
    public function error(Host $host)
    {
    }
}
