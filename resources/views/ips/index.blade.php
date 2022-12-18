<x-app-layout>
    <h3>IP 地址</h3>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>IP 地址</th>
                <th>地址池</th>
                <th>价格</th>
                <th>操作</th>
            </tr>
        </thead>


        <tbody>
            @foreach ($ips as $ip)
                <tr>
                    <td>{{ $ip->id }}</td>
                    <td>{{ $ip->ip }}</td>
                    <td>{{ $ip->pool->pool }}</td>
                    <td>{{ $ip->price ?? $ip->pool->price }}</td>
                    {{-- <td>
                        <a href="{{ route('pools.edit', $pool->id) }}">编辑</a>
                        <a href="{{ route('pools.show', $pool->id) }}">IP 列表</a>

                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>


    {{ $ips->links() }}


</x-app-layout>
