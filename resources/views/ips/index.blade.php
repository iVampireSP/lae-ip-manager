<x-app-layout>
    <h3>IP 地址</h3>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>IP 地址</th>
                <th>地址池</th>
                <th>主机名</th>
                <th>MAC</th>
                <th>操作</th>
            </tr>
        </thead>


        <tbody>
            @foreach ($ips as $ip)
                <tr>
                    <td>{{ $ip->id }}</td>
                    <td>
                        {{ $ip->ip }}
                        <br />
                        @if ($ip->blocked)
                            <span class="badge bg-primary">保留</span>
                        @endif
                        @if ($ip->module_id)
                            <span class="badge bg-primary">分配给模块 ID: {{ $ip->module_id }}</span>
                        @endif
                        @if ($ip->host_id)
                            <span class="badge bg-secondary">Host ID: {{ $ip->host_id }}</span>
                        @endif
                    </td>
                    <td>{{ $ip->pool->pool }}</td>
                    <td>{{ $ip->hostname }}</td>
                    <td>{{ $ip->mac }}</td>
                    <td>
                        <a href="{{ route('ips.edit', $ip->id) }}">编辑</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    {{ $ips->links() }}
</x-app-layout>
