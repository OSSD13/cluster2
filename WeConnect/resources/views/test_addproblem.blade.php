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

    <form action="{{ url('/showimage') }}" method="post">
        @csrf
        <button type="submit">show</button>
    </form>

</body>