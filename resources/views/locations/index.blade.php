<x-app-layout>
    <h3>地区</h3>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>代码</th>
            <th>操作</th>
        </tr>
        </thead>


        <tbody>
        @foreach ($locations as $location)
            <tr>
                <td>{{ $location->id }}</td>
                <td>{{ $location->name }}</td>
                <td>{{ $location->code }}</td>
                <td>
                    <a href="{{ route('hosts.show', $host->id) }}">编辑</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    {{ $hosts->links() }}
</x-app-layout>
