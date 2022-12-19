<x-app-layout>
    <h3>地址池</h3>

    <a href="{{ route('pools.create') }}">新建地址池</a>


    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>网段</th>
                <th>子网掩码</th>
                <th>版本</th>
                <th>继承价格</th>
                <th>操作</th>
            </tr>
        </thead>


        <tbody>
            @foreach ($pools as $pool)
                <tr>
                    <td>{{ $pool->id }}</td>
                    <td>{{ $pool->pool }}</td>
                    <td>{{ $pool->netmask }}</td>
                    <td>{{ $pool->type }}</td>
                    <td>{{ $pool->price ?? 0 }} 元</td>
                    <td>
                        <a href="{{ route('pools.edit', $pool->id) }}">编辑</a>
                        <a href="{{ route('ips.index') }}?pool_id={{ $pool->id }}">IP 列表</a>
                        <a href="{{ route('pools.generate', $pool->id) }}">生成</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</x-app-layout>
