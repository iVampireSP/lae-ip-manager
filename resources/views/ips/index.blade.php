<x-app-layout>
    <h3>IP 地址</h3>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>IP 地址</th>
                <th>地址池</th>
                <th>主机名</th>
                <th>价格</th>
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
                            <span class="badge bg-danger">冻结</span>
                        @endif
                        @if ($ip->host_id)
                            <span class="badge bg-success">已分配</span>
                        @endif
                    </td>
                    <td>{{ $ip->pool->pool }}</td>
                    <td>{{ $ip->hostname }}</td>
                    <td>{{ $ip->price ?? $ip->pool->price }}</td>
                    <td>
                        <a href="#">信息</a>
                        <a href="#">编辑</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    {{ $ips->links() }}
</x-app-layout>
