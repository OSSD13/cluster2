<!DOCTYPE html>

<body>
    <form action="{{ route('addimage') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label class="block mt-2 text-sm">รูปภาพ</label>
        <div class="flex gap-2 items-center">
            <input type="file" id="photo" name="photo" />
            <div id="preview" class="flex gap-2"></div>
        </div>

        <button type="submit">submit</button>
    </form>

    <form action="{{ route('showimage') }}" method="post">
        @csrf
        <input type="text" id="show" name="show"></input>
        <button type="submit">show</button>
    </form>
</body>