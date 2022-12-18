<x-app-layout>
    <h3>可用区</h3>

    <a href="{{ route('regions.create') }}">新建可用区</a>

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
            @foreach ($regions as $region)
                <tr>
                    <td>{{ $region->id }}</td>
                    <td>{{ $region->name }}</td>
                    <td>{{ $region->code }}</td>
                    <td>
                        <a href="{{ route('regions.edit', $region->id) }}">编辑</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
