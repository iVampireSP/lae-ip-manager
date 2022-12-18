<x-app-layout>
    <h3>新建可用区</h3>

    <form action="{{ route('regions.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">名称</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">地区代码</label>
            <input type="text" class="form-control" id="code" name="code"
                value="{{ old('code') }}">
        </div>

        <button type="submit" class="btn btn-primary">提交</button>
    </form>

</x-app-layout>
