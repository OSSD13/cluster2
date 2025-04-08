@extends('layouts.layout_user')

@section('content')

<h1 class="text-2xl font-semibold mt-4 text-left px-6">เพิ่มข้อมูล</h1>
<div class="p-4">
    <!-- ชื่อชุมชน -->
    <label class="block mt-2 text-sm">ชื่อของชุมชน</label>
    <input type="text" id="community_name" name="community_name" class="w-full p-2 border rounded" placeholder="กรอกชื่อชุมชน">

    <!-- วันที่ & ตำแหน่ง -->
    <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block mt-2 text-sm">วันที่ <span class="text-red-500">*</span></label>
            <div class="flex items-center border p-2 rounded">
                <i class="fa-solid fa-calendar-days"></i>
                <input type="date" id="add_date" name="add_date" class="w-full border-none focus:ring-0 ml-2">
            </div>
        </div>
        <div>
            <label class="block mt-2 text-sm">ตำแหน่ง <span class="text-red-500">*</span></label>
            <div class="flex items-center border p-2 rounded">
                <i class="fa-solid fa-location-dot"></i>
                <input id="location" name="location" type="text" class="w-full border-none focus:ring-0 ml-2" placeholder="เลือกตำแหน่งจากแผนที่">
                <button onclick="openGoogleMaps()" class="ml-2">➤</button>
            </div>
        </div>
    </div>

    <!-- ที่อยู่ -->
    <label class="block mt-4 text-sm">ที่อยู่ <span class="text-red-500">*</span></label>
    <!-- ช่องที่อยู่เพิ่มเติม -->
    <input id="sub_district" name="sub_district" type="text" placeholder="ตำบล" class="mt-2 w-full border p-2 rounded">
    <input id="district" name="district" type="text" placeholder="อำเภอ" class="mt-2 w-full border p-2 rounded">
    <input id="province" name="province" type="text" placeholder="จังหวัด" class="mt-2 w-full border p-2 rounded">
    <input id="postcode" name="postcode" type="text" placeholder="รหัสไปรษณีย์" class="mt-2 w-full border p-2 rounded">

    <!-- ปัญหาที่พบ -->
    <label class="block mt-4 text-sm">ปัญหาที่พบ <span class="text-red-500">*</span></label>
    <div class="tags-input-wrapper w-full p-2 border rounded relative">
        <ul id="tags">
            <input type="text" id="tag-input" spellcheck="false" placeholder="พิมพ์ปัญหาแล้วกด Enter">
        </ul>
        <button onclick="openTagModal()" class="absolute right-2 top-2 bg-blue-500 text-white px-2 py-1 rounded">+</button>
    </div>

    <!-- Modal สำหรับเพิ่มแท็กใหม่ -->
    <div id="tagModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-80">
            <h2 class="text-lg font-semibold mb-4">เพิ่มแท็กใหม่</h2>
            <input type="text" id="newTagInput" class="w-full p-2 border rounded mb-4" placeholder="กรอกแท็กที่ต้องการเพิ่ม">
            <div class="flex justify-end gap-2">
                <button onclick="closeTagModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">ยกเลิก</button>
                <button onclick="addTagFromModal()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">เพิ่ม</button>
            </div>
        </div>
    </div>

    <!-- รายละเอียดเพิ่มเติม -->
    <label class="block mt-4 text-sm">รายละเอียดเพิ่มเติม</label>
    <textarea class="w-full p-2 border rounded"></textarea>


    <label class="block mt-2 text-sm">รูปภาพ</label>
    <div class="flex gap-2 items-center">
        <button id="uploadButton" class="px-4 py-2 bg-blue-500 text-white rounded">เลือกไฟล์</button>
        <input type="file" id="imageInput" accept="image/*" class="hidden" />
        <div id="preview" class="flex gap-2"></div>
    </div>
    <p id="warningText" class="text-red-500 text-sm mt-2 hidden">สามารถอัปโหลดได้สูงสุด 2 รูปเท่านั้น</p>

    <!-- Modal Popup -->
    <div id="popupModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-4 rounded shadow-md max-w-sm w-full text-center">
            <p class="text-red-600 font-semibold">สามารถอัปโหลดได้สูงสุด 2 รูปเท่านั้น</p>
            <button id="closeModal" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">ตกลง</button>
        </div>
    </div>

    <!-- ปุ่ม ยืนยัน -->
    <div class="flex justify-center mt-6">
        <button class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
            ยืนยันข้อมูล
        </button>
    </div>
</div>
<script>
    const uploadedImages = [];

document.getElementById('uploadButton').addEventListener('click', function () {
  document.getElementById('imageInput').click();
});

document.getElementById('imageInput').addEventListener('change', function(event) {
    const newFiles = Array.from(event.target.files);
    const warningText = document.getElementById('warningText');

    // ไม่ต้องจำกัดจำนวนรูป
    warningText.classList.add('hidden');

    newFiles.forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            uploadedImages.push(e.target.result);
            renderPreview();
        };
        reader.readAsDataURL(file);
    });

    event.target.value = '';
});

function renderPreview() {
    const preview = document.getElementById('preview');
    preview.innerHTML = '';

    uploadedImages.forEach((imgSrc, index) => {
        const wrapper = document.createElement('div');
        wrapper.className = "relative";

        const img = document.createElement('img');
        img.src = imgSrc;
        img.className = "w-16 h-16 object-cover rounded-md";

        const removeBtn = document.createElement('button');
        removeBtn.textContent = "✕";
        removeBtn.className = "absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center";
        removeBtn.onclick = () => {
            uploadedImages.splice(index, 1);
            renderPreview();
        };

        wrapper.appendChild(img);
        wrapper.appendChild(removeBtn);
        preview.appendChild(wrapper);
    });
}

document.getElementById('closeModal').addEventListener('click', function () {
  document.getElementById('popupModal').classList.add('hidden');
});

    $.Thailand({
        $district: $("#sub_district"), // input ของตำบล
        $amphoe: $("#district"), // input ของอำเภอ
        $province: $("#province"), // input ของจังหวัด
        $zipcode: $("#postcode") // input ของรหัสไปรษณีย์
    });
</script>
</div>
@endsection

<style>
    .tags-input-wrapper {
        background: #fff;
        border: 1px solid #d1d5db;
        border-radius: 0.25rem;
        padding: 10px;
    }

    #tags {
        display: flex;
        flex-wrap: wrap;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    #tags li {
        display: flex;
        align-items: center;
        margin: 4px;
        padding: 5px 8px;
        background: #e5e7eb;
        border-radius: 5px;
        font-size: 14px;
    }

    #tags li.highlight {
        background: #2563eb;
        color: #fff;
    }

    #tags li .remove-tag {
        margin-left: 8px;
        font-size: 14px;
        cursor: pointer;
        color: #888;
    }

    #tags li .remove-tag:hover {
        color: #f00;
    }

    #tags input {
        flex: 1;
        padding: 5px;
        border: none;
        outline: none;
        font-size: 14px;
    }
</style>

<script>
    window.onload = function() {
        if (localStorage.getItem('form_data') || localStorage.getItem('latitude')) {
            const data = JSON.parse(localStorage.getItem('form_data'));
            document.getElementById('location').value = `latitude: ${localStorage.getItem('latitude')}, longitude: ${localStorage.getItem('longitude')}` || '';
        }
    }

    function saveFormToStorage() {
        const data = {
            title: document.getElementById('title').value,
            description: document.getElementById('description').value
        };

        localStorage.setItem('form_data', JSON.stringify(data));
    }

    function openGoogleMaps() {
        let address = document.getElementById("location").value;
        let url = "/addmap";
        window.open(url, "_self");
    }

    document.addEventListener('DOMContentLoaded', function() {
        const tagInput = document.getElementById('tag-input');
        const tags = document.getElementById('tags');
        const maxTags = 10000;
        let tagsList = [];

        function createTag(tagValue) {
            if (!tagValue.startsWith('#')) {
                tagValue = '#' + tagValue;
            }

            const li = document.createElement('li');
            const span = document.createElement('span');
            span.className = 'remove-tag';
            span.innerHTML = '×';

            li.textContent = tagValue + ' ';
            li.appendChild(span);

            span.addEventListener('click', function() {
                removeTag(li, tagValue);
            });

            tags.insertBefore(li, tagInput);
            tagsList.push(tagValue);
        }

        function removeTag(element, tag) {
            const index = tagsList.indexOf(tag);
            if (index > -1) {
                tagsList.splice(index, 1);
            }
            element.remove();
        }

        tagInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                const tagValue = this.value.trim();
                if (tagValue && !tagsList.includes('#' + tagValue) && !tagsList.includes(tagValue)) {
                    if (tagsList.length < maxTags) {
                        createTag(tagValue);
                        this.value = '';
                    }
                }
            }
        });
    });

    function openTagModal() {
        document.getElementById("tagModal").classList.remove("hidden");
    }

    function closeTagModal() {
        document.getElementById("newTagInput").value = "";
        document.getElementById("tagModal").classList.add("hidden");
    }

    function addTagFromModal() {
        const tagInputValue = document.getElementById("newTagInput").value.trim();
        if (tagInputValue && !tagsList.includes('#' + tagInputValue) && !tagsList.includes(tagInputValue)) {
            if (tagsList.length < maxTags) {
                createTag(tagInputValue);
                closeTagModal();
            }
        }
    }
</script>
