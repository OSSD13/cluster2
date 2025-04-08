<!DOCTYPE html>

<body>
    <form action="{{ url('/addimage') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label class="block mt-2 text-sm">รูปภาพ</label>
        <div class="flex gap-2 items-center">
            <input type="file" id="photo" name="photo" />
            <div id="preview" class="flex gap-2"></div>
        </div>

        <button type="submit">submit</button>
    </form>

    <form action="{{ url('/showimage') }}">
        @csrf
        <button type="submit">show</button>
    </form>

    <img src="{{ asset('storage/app/public/' . 'images/9Aa5GgRcJT77U8zuMJSqnEAcsYINcJ7MhKzz7a9Y.png') }}" alt="รูปภาพ" width="200">

</body>