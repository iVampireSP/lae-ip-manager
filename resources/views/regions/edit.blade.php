<x-app-layout>
    <h3>编辑 {{ $region->name }}</h3>

    <form action="{{ route('regions.update', $region->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">名称</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $region->name }}">
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">地区代码</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ $region->code }}">
        </div>

        <button type="submit" class="btn btn-primary">提交</button>
    </form>

    <hr />

    <form action="{{ route('regions.destroy', $region->id) }}" method="post">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">删除</button>
    </form>

</x-app-layout>
