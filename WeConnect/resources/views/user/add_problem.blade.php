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
            <input type="text" id="tag-input" list="tagSuggestions" spellcheck="false" placeholder="พิมพ์ปัญหาแล้วกด Enter เพื่อเพิ่ม">
            <datalist id="tagSuggestions"></datalist>
        </ul>
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

        // โหลดแท็กจาก backend แล้วเพิ่มใน datalist + allowedTags
        fetch("{{ route('tags.fetch') }}")
            .then(response => response.json())
            .then(data => {
                const datalist = document.getElementById("tagSuggestions");
                datalist.innerHTML = '';
                data.forEach(tag => {
                    const option = document.createElement("option");
                    option.value = tag;
                    datalist.appendChild(option);
                    allowedTags.push(tag); // อัปเดต allowedTags ด้วย
                });
            })
            .catch(error => {
                console.error("เกิดข้อผิดพลาดในการโหลดแท็ก:", error);
            });

        // Event listener สำหรับการกด Enter เพื่อเพิ่มแท็ก
        tagInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                const tagValue = this.value.trim();
                if (tagValue) {
                    handleTagInput(tagValue);
                }
            }
        });
    });

    // ประกาศตัวแปรแบบ global
    let tagsList = [];
    let allowedTags = []; // สำหรับเก็บแท็กที่มีอยู่ในระบบ
    const maxTags = 10000;

    // ฟังก์ชันสำหรับจัดการกับแท็ก
    function createTag(tagValue) {
        const tags = document.getElementById('tags');
        const tagInput = document.getElementById('tag-input');

        if (!tagValue) return;

        // ตัดช่องว่าง
        tagValue = tagValue.trim();
        if (tagValue === '') return;

        // ตรวจสอบว่าแท็กซ้ำหรือไม่
        const formattedTag = "#" + tagValue;
        if (tagsList.includes(formattedTag)) return;

        // สร้าง element ใหม่สำหรับแท็ก
        const li = document.createElement('li');
        const span = document.createElement('span');
        span.className = 'remove-tag';
        span.innerHTML = '×';

        li.textContent = formattedTag + ' ';
        li.appendChild(span);

        // เพิ่ม event listener สำหรับลบแท็ก
        span.addEventListener('click', function() {
            removeTag(li, formattedTag);
        });

        // เพิ่มแท็กเข้าไปใน DOM และ array
        tags.insertBefore(li, tagInput);
        tagsList.push(formattedTag);

        // ล้างค่าในช่อง input
        tagInput.value = '';

        return true; // แสดงว่าเพิ่มแท็กสำเร็จ
    }

    function removeTag(element, tag) {
        // ลบแท็กออกจาก array
        const index = tagsList.indexOf(tag);
        if (index > -1) {
            tagsList.splice(index, 1);
        }
        // ลบ element ออกจาก DOM
        element.remove();
    }

    // ฟังก์ชันเพิ่มแท็กใหม่ (ทั้งแท็กที่มีอยู่หรือสร้างใหม่)
    function handleTagInput(tagValue) {
        if (!tagValue) return;

        // ตรวจสอบว่าแท็กนี้มีอยู่แล้วในระบบหรือไม่
        if (allowedTags.includes(tagValue)) {
            // ถ้ามีอยู่แล้ว เพิ่มแท็กได้เลย
            createTag(tagValue);
        } else {
            // ถ้ายังไม่มี ส่งข้อมูลไปบันทึกแท็กใหม่ที่ backend ก่อน
            fetch("{{ route('tags.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        tag_name: tagValue
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // เพิ่มแท็กเข้า list ที่อนุญาต
                        allowedTags.push(tagValue);

                        // เพิ่มแท็กใน datalist
                        const datalist = document.getElementById("tagSuggestions");
                        const option = document.createElement("option");
                        option.value = tagValue;
                        datalist.appendChild(option);

                        // สร้างแท็กและแสดงในรายการ
                        createTag(tagValue);
                    } else {
                        if (data.message === 'แท็กนี้มีอยู่แล้ว') {
                            // กรณีนี้ไม่ควรเกิดขึ้นแล้ว แต่เผื่อไว้
                            createTag(tagValue);
                        } else {
                            alert("ไม่สามารถเพิ่มแท็กได้: " + data.message);
                        }
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("เกิดข้อผิดพลาดในการเพิ่มแท็ก");
                });
        }
    }
</script>